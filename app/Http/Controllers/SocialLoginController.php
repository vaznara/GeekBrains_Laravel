<?php

namespace App\Http\Controllers;

use App\SocialUser;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{

    public function login($socialNetwork) {

        $socialNetwork = ($socialNetwork == 'google' ? ucfirst($socialNetwork) : $socialNetwork);

        return Socialite::with($socialNetwork)->redirect();
    }

    public function response($socialNetwork)
    {
        $socialNetwork = ($socialNetwork == 'google' ? ucfirst($socialNetwork) : $socialNetwork);
        $user = Socialite::driver($socialNetwork)->user();

        $socialUser = new SocialUser();
        $result = $socialUser->findOrCreateSocialUser($user, $socialNetwork);

        if($result) {
            return redirect()->route('Home')->with(['success' => 'Вы успешно вошли в систему']);
        } else {
            return redirect()->route('Home')->with(['error' => 'Ошибка авторизации']);
        }
    }
}
