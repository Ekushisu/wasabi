<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Controllers\Pi3iiBaseController;
use Input;
use Carbon\Carbon;
use Auth;
use Hash;
use Mail;

class AuthController extends Pi3iiBaseController
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

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
    }

    protected function postLogin()
    {
        $validator = Validator::make(
            Input::all(),
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );

        if ($validator->fails())
            return redirect()->back()->withErrors("Un champ n'a pas été entré correctement.");

        $user = User::where('username', Input::get('username'))->where('banned', '!=', '2')->first();

        if ( $user !== null && $user->password == md5(hash('sha512', Input::get('password'))) )
        {
            if($user->banned == 1)
                return redirect()->back()->withErrors("Identifiants révoqués, accès non autorisé");
            if($user->active == 2)
                return redirect()->back()->withErrors("Identifiants révoqués, accès non autorisé");

            $user->save();

            Auth::login($user);
            return redirect()->route('data.home');
        }
        return redirect()->back()->withErrors("Vos identifiants sont incorrects.");
    }

    protected function postRegister()
    {
        $validator = Validator::make(
            Input::all(),
            [
                'username' => 'required',
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email',
            ]

        );



        if ($validator->fails())
            return redirect()->back()->withErrors("Un champ n'a pas été entré correctement.");

        if (User::where('username', Input::get('username'))->first() !== null)
            return redirect()->back()->withErrors(["Ce nom d'utilisateur n'est pas disponible."])->withInput();

        if (User::where('email', Input::get('email'))->first() !== null)
            return redirect()->back()->withErrors(["Cette adresse e-mail n'est pas disponible."])->withInput();





        $email_exploded = explode('@', Input::get('email'));
        $allowed_domains = file_get_contents(storage_path("allowed_domains.txt"));
        $allowed_domains = explode("\n", $allowed_domains);
        $allowed_domains = array_map('trim', $allowed_domains);

        if (!in_array($email_exploded[1], $allowed_domains))
            return redirect()->back()->withErrors(["Cette adresse e-mail n'est pas autorisée."])->withInput();


        $user = new User;
        $userPassword['clear'] = str_random(5);
        $userPassword['hashed'] = Hash::make($userPassword['clear']);

        $user->username = Input::get('username');
        $user->password = $userPassword['hashed'];
        $user->email = Input::get('email');
        $user->firstName = Input::get('firstName');
        $user->lastName = Input::get('lastName');
        $user->background = Input::get('background') ? nl2br(Input::get('background')): null;
        $user->level = 0;
        $user->rank_id = 1;

        $user->save();

        Mail::send('emails/confirm-registration', ['user' => $user, 'pass' => $userPassword['clear']], function($message) use ($user)
        {
            $message->from('contact@pie3.2.ga', '[PI 3.II] Garde Républicaine ArmA');
            $message->to($user->email)->subject("Confirmation de demande d'admission");
        });

        Auth::login($user);

        return redirect()->route('data.home');
    }

    /**
     * Handles data to login the user
    */
    protected function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
