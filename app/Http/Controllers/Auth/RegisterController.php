<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Organization;
use App\Profile;
use Notification;
use App\Notifications\SendUserPassword;
use Spatie\Permission\Models\Role;

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
     * Where to redirect users after registration.
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
        $this->middleware(['auth', 'role:admin']);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            'organization' => ['required'],
            'user_type' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // ~14 characters, includes /=+
        $randomString = str_random(8);

        $organization = Organization::find($data['organization']);
        // Assign organization and create user
        $user = $organization->users()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($randomString),
        ]);
        // Attaching Profile
        Profile::create([
            'user_id' => $user->id,
            'gender' => 'O',
            'picture' => 'users/user.png'
        ]);

        // Attaching role
        //$user->role()->attach($data['user_type']);
        $user->assignRole($data['user_type']);

        // Send password email
        Notification::route('mail', $user->email)->notify(new SendUserPassword($randomString));

        return $user;
    }
}
