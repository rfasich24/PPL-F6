<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);

        return view('profile', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthday' => ['required', 'date'],
            'phone_number' => ['string'],
            'address' => ['string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $validateData = $request->validate($rules);

        User::where('id', $id)
                ->update($validateData);

        return redirect('/home');
    }
}
