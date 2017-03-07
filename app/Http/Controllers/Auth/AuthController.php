<?php

namespace Nht\Http\Controllers\Auth;

use Validator;
use Socialite;
use Illuminate\Http\Request;
use Nht\Hocs\Users\UserRepository;
use Nht\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth, Xss;
use Nht\Hocs\Core\Metadata\MetadataTrait;
use Nht\Jobs\SendRegisterEmail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, MetadataTrait;

    protected $redirectPath = '/auth/register_successful.html';
    protected $user;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->getMetadata();
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

    public function getRegisterSuccess()
    {
        return view('auth.register_successful');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->user->create($request->all());
        $emailJob = (new SendRegisterEmail($user))->delay(2*60);

        $this->dispatch($emailJob);

        return redirect($this->redirectPath());
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->user->create([
            'email' => Xss::clean($data['email']),
            'password' => bcrypt($data['password']),
        ]);
    }
}
