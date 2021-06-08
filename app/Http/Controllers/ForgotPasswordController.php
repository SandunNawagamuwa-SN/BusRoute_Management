<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    
    public function forgot() {
        
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        $response = [
            'messsage' => 'Reset password link sent on your email'
        ];

        return response($response);
    }

    public function reset(){
        
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required|string|max:25|confirmed',
            'token' => 'required|string'
        ]);

        $email_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if($email_password_status == Password::INVALID_TOKEN){

            $response = [
                'messsage' => 'Invalid token provided'
            ];

            return response($response);
        }

        $response = [
            'messsage' => 'Password change succesfully'
        ];

        return response($response);
    }
}
