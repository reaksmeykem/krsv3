<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {


        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();



            if($finduser){
                Auth::login($finduser);
                return redirect()->route('dashboard');
            }
            else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'photo' => $user->avatar
                ]);
                // assign role guest
                $role = Role::where('id', 16)->first();
                $newUser->syncRoles($role);

                Auth::login($newUser);
                return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());

        }
    }
}
