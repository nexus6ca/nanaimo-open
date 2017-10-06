<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\RatingController;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name'              => 'required|max:255',
            'email'             => 'required|email|max:255|unique:users',
            'city'              => 'required|max:255',
            'prov'              => 'required|max:3',
            'password'          => 'required|min:6|confirmed',
            'cfc_number'        => 'integer',
            'cfc_expiry_date'   => 'date',
            'age'               => 'required'
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
        // Updating user rating.
        $rating = new RatingController();
        $data['rating'] = $rating->getRating($data['cfc_number']);
        $data['cfc_expiry_date'] = $rating->getExpiry($data['cfc_number'])->format('Y-m-d');

        return User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'city'          => $data['city'],
            'prov'          => $data['prov'],
            'password'      => bcrypt($data['password']),
            'cfc_number'    => $data['cfc_number'],
            'rating'        => $data['rating'],
            'cfc_expiry_date' => $data['cfc_expiry_date'],
            'age'           => $data['age']
        ]);
    }

    protected function authenticated(Request $request, User $user)
    {
        return redirect()->back();
    }
}
