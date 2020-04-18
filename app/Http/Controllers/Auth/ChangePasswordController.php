<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function showChangePasswordForm()
    {
        return view('auth.passwords.change', ['user' => Auth::user()]);
    }

    public function passwordUpdate(Request $request)
    {

        $request->validate(['password' => 'confirmed|required']);

        $user = Auth::user();

        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('Home')->with(['success' => 'пароль был успешно изменен']);
    }
}
