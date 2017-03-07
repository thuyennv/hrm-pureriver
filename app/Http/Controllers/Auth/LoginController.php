<?php

namespace App\Http\Controllers\Auth;

use Socialite, Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Nht\Hocs\Users\UserRepository;
use Nht\Hocs\Core\Metadata\MetadataTrait;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->getMetadata();
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Override getLogin method in Illuminate/Auth/AuthenticatesUsers trait
     * @return View
     */
    public function getLogin()
    {
        $this->metadata->setMetaTitle('Đăng nhập');
        return view('auth.login');
    }

    /**
     * Override getRegister method in Illuminate/Auth/RegistersUsers trait
     * @return View
     */
    public function getRegister()
    {
        $this->metadata->setMetaTitle('Đăng ký');
        return view('auth.register');
    }

    /**
     * Using socialite for authentication.
     * @param  string $provider
     * @return Redirect
     */
    public function loginWithSocialite(Request $request, $provider = 'facebook')
    {
        if ($request->get('code')) {
            try {
                $user = Socialite::driver($provider)->user();
            } catch(\Exception $e) {
                return redirect()->route('auth.socialite', $provider);
            }

            $authUser = $this->user->loginWithSocialite($user, $provider);

            Auth::login($authUser, true);

            return redirect()->intended($this->redirectPath);
        }
        return Socialite::driver($provider)->redirect();
    }
}
