<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;
use BitWasp\Bitcoin\Crypto\Random\Random;
use kornrunner\Keccak;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $random = new Random();
        $privateKey = PrivateKeyFactory::fromHex($random->bytes(32)->getHex());
        $publicKey = $privateKey->getPublicKey();
        $publicKeyHash = Keccak::hash(substr(hex2bin($publicKey->getHex()), 1), 256);
        $address = '0x' . substr($publicKeyHash, -40);
        $privateKeyHex = '0x' . $privateKey->getBuffer()->getHex();
      

        return DB::transaction(function () use ($input, $address, $privateKeyHex) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'eth_address' =>  $address,
                'eth_private_key' => $privateKeyHex,
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}


