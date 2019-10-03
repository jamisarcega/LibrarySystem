<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Token;
use Hash;
class RegistrationController extends Controller
{
    public function userRegistration(Request $request)
    {
        $password = $request->password;
        $confirm = $request->password_confirmation;
        if($password == $confirm){
            $token = Token::where('token',$request->token)->first();
            if(!$token){
                return redirect()->back();
            }
            $user = new User;
            $user->first_name = $request->name;
            $user->middle_name = $request->middle;
            $user->last_name = $request->last;
            $user->extension = $request->extension;
            $user->email = $request->email;
            $user->password = Hash::make($password);
            $user->save();

            $token->status = 0;
            $token->save();

        }
        return redirect()->back();
    }
}
