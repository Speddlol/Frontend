<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Entry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JackpotGameControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can join a game.
     *
     * @return void
     */
    public function testUserCanJoinGame()
    {
        // Create a game and save it to the database
        $game = new JackpotGame;
        $game->name = 'Test Game';
        $game->save();

        // Submit a request to join the game
        $response = $this->post('/join-game', [
            'game_id' => $game->id,
            'user_id' => 1,
            'fee' => 10,
        ]);

        // Assert that the response is successful
        $response->assertSuccessful();

        // Assert that the game has one entry
        $this->assertCount(1, $game->entries);

        // Assert that the entry belongs to the correct user
        $this->assertEquals(1, $game->entries->first()->user_id);
    }

    /**
     * Test that a game is redirected to the game page when there are enough players.
     *
     * @return void
     */
    public function testGameRedirectsToGamePageWhenThereAreEnoughPlayers()
    {
        // Create a game and save it to the database
        $game = new JackpotGame;
        $game->name = 'Test Game';
        $game->save();
        
        // Add two entries to the game
        $entry1 = new jackpotGame_entries;
        $entry1->user_id = 1;
        $entry1->fee = 10;
        $entry1->time = now();
        $entry1->game_id = $game->id;
        $entry1->save();
        
        $entry2 = new jackpotGame_entries;
        $entry2->user_id = 2;
        $entry2->fee = 10;
        $entry2->time = now();
        $entry2->game_id = $game->id;
        $entry2->save();

        // Submit a request to join the game
        $response = $this->post('/join-game', [
            'game_id' => $game->id,
            'user_id' => 3,
            'fee' => 10,
        ]);

        // Assert that the response is a redirect to the game page
        $response->assertRedirect(route('games.show', ['game' => $game]));
    }
}
