<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function changePassword(){
        return view('general.profile.change-password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $changePassword = User::find(Auth::user()->id);
        $changePassword->password = Hash::make($request->password);
        $changePassword->save();

        return redirect()->back()->with('status', 'Successfuly updated psaasword');
    }
}
