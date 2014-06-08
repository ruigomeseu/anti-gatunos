<?php

use Gatunos\Services\UserCreator;

class UsersController extends \BaseController {

    protected $userCreator;

    function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    /**
     * Redirects the user to the Facebook Login Page
     */
    public function create() {
        $facebook = new Facebook(Config::get('facebook'));
        $params = array(
            'redirect_uri' => url('/login/fb/callback'),
            'scope' => 'email',
        );
        return Redirect::to($facebook->getLoginUrl($params));
    }

    /**
     * Grabs the input from Facebook and stores the user
     * in the database
     */
    public function store() {

        try {
            $this->userCreator->make(Input::all());
        } catch(\Gatunos\Exceptions\FacebookLoginException $e) {
            return Redirect::route('home')->with('message', 'Ocorreu um erro durante a comunicação com o Facebook. Tente mais tarde');
        }

        return Redirect::route('home')->with('message', 'Login efectuado com sucesso.');
    }


} 