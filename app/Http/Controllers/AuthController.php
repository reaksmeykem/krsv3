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

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
    
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function guestLogout(){
        auth()->logout();
        return redirect()->back();
    }
    public function handleGithubCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
            $finduser = User::where('github_id', $user->id)->first();
            if($finduser){
                $user = Auth::login($finduser);
                if($finduser->roles->pluck('name')[0] == 'Guest'){
                    return redirect()->back();
                }else{
                    return redirect()->route('dashboard');
                }

            }
            else{
                $newUser = User::create([
                    'name' => $user->nickname,
                    'email' => $user->email,
                    'github_id'=> $user->id,
                    'photo' => $user->avatar
                ]);
                // assign role guest
                $role = Role::where('id', 16)->first();
                $newUser->syncRoles($role);

                Auth::login($newUser);
                return redirect()->back();
            }
        } catch (Exception $e) {
            dd($e->getMessage());

        }
    }

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
