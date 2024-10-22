<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{


    function register(Request $request)
    {

        try {
            DB::beginTransaction();


            $user = new Member();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);

            $user->save();
            DB::commit();
            return redirect('login')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to register user');
        }
    }

   

    function login(Request $request)
    {
        $user = Member::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Log in the user
            Auth::login($user);

            return redirect('home');
        } else {
            // dd('User not found');

            return redirect()->back()->with('error', 'Invalid Credential');
        }
    }
    function logout()
    {

        Auth::logout();
        return redirect('login');
    }
}
