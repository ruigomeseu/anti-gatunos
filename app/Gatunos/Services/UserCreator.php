<?php namespace Gatunos\Services;

use Gatunos\Exceptions\FacebookLoginException;

class UserCreator {

    public function make(array $data) {
        if(strlen($data['code']) == 0) {
            throw new FacebookLoginException;
        }

        $facebook = new \Facebook(\Config::get('facebook'));
        $uid = $facebook->getUser();

        if ($uid == 0) {
            throw new FacebookLoginException;
        }

        $me = $facebook->api('/me');

        $profile = \Profile::whereUid($uid)->first();
        if (empty($profile)) {

            $user = new \User;
            $user->name = $me['first_name'].' '.$me['last_name'];
            $user->email = $me['email'];

            $user->save();

            $profile = new \Profile();
            $profile->uid = $uid;
            $profile = $user->profiles()->save($profile);
        }

        $profile->access_token = $facebook->getAccessToken();
        $profile->save();

        $user = $profile->user;

        \Auth::login($user);

        return true;
    }

}