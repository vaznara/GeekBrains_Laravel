<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialUser extends Model
{
    protected $fillable = [
        'user_id', 'social_network', 'user_social_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function findOrCreateSocialUser($socialUser, $socialNetwork)
    {
        $user = User::query()->where('email', '=', $socialUser->email)->first();

        if ($user) {
            $socialUserId = SocialUser::query()
                ->where('user_id', '=', $user->id)
                ->where('social_network', '=', $socialNetwork)
                ->first();

            if($socialUserId) {
                Auth::loginUsingId($user->id);
                $user->social_avatar_uri = $socialUser->avatar;
                $user->save();
                return true;
            } else {
                $user->social_avatar_uri = $socialUser->avatar;
                $user->save();
                return $this->createSocialUser($user, $socialUser, $socialNetwork);
            }
        }
        return $this->createUser($socialUser, $socialNetwork);
    }

    private function createUser($user, $socialNetwork) {

        $userModel = new User();
        $userData = [
            'name' => ($user->name ? $user->name : $user->nickname),
            'email' => $user->email,
            'email_verified_at' => now(),
            'social_avatar_uri' => $user->avatar,
            'password' => Hash::make(Str::random(8))
        ];

        $userModel->fill($userData)->save();

        return $this->createSocialUser($userModel, $user, $socialNetwork);
    }

    private function createSocialUser($user, $socialUser, $socialNetwork) {

        $user->social_avatar_uri = $socialUser->avatar;
        $user->save();

        $socialUserModel = new SocialUser();

        $socialUserData = [
            'user_id' => $user->id,
            'social_network' => $socialNetwork,
            'user_social_id' => $socialUser->id
        ];

        $socialUserModel->fill($socialUserData)->save();
        Auth::loginUsingId($user->id);
        return true;
    }
}
