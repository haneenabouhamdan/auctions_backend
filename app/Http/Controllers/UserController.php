<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function edit_profile($request){

        $user = User::findOrFail(Auth::id());
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');
        $user->date_of_birth = $request->get('date_of_birth');
        $user->balance = $request->get('balance');
        $user->email = $request->get('email');
        $user->country = $request->get('country');
        $suer->state = $request->get('state');

        $user->save();

        return json_encode($user);
    }
}
