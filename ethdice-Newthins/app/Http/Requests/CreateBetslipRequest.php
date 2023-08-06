<?php

namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;

class CreateBetslipRequest extends FormRequest
{
    public function authorize()
    {
        // TODO: Replace this with your own logic.
        // Only allow logged in users.
        // You may need to tweak this to fit your needs
        return auth()->check();
    }
    
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'odd_one' => 'required|numeric',
            'odd_two' => 'required|numeric',
            'odd_three' => 'required|numeric',
            'description' => 'required|string|max:500', // adjust validation rules as necessary
            'picture' => 'required|image|max:2048', // adjust validation rules as necessary
        ];
    }
}