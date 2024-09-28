<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleLoginController extends Controller
{

    protected $_config;
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->_config = request('_config');
        $this->userRepository = $userRepository;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = $this->userRepository->where('email', $googleUser->email)->first();
        if(!$user)
        {
            $user = $this->userRepository->create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => rand(100000,999999)]);
        }

        Auth::login($user);

        return redirect()->route($this->_config['redirect'])->with('success', trans("global.success_login"));
    }
}
