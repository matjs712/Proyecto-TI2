<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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
    protected $redirectTo = '/';

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
        return Validator::make(
            $data,
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'password_confirmation' => ['required', 'min:8', 'max:50', 'same:password'],
            ],
            [
                'name.required' => 'El nombre de usuario es obligatorio.',
                'email.required' => 'EL email debe ser obligatorio.',
                'password.required' => 'La contraseña debe ser obligatoria.',
                'password_confirmation.required' => 'La confirmacion de contraseña debe ser obligatoria.',
                'password.max' => 'La contraseña debe tener como maximo :max caracteres.',
                'password.min' => 'La contraseña debe tener al menos :min caracteres.',
                'password_confirmation.max' => 'La contraseña debe tener como maximo :max caracteres.',
                'password_confirmation.min' => 'La contraseña debe tener al menos :min caracteres.',
                'password_confirmation.same' => 'Las contraseñas no coinciden.'


            ]

        );

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $notifications = new Notification();
        $notifications->detalle = 'Se unido el nuevo usuario: ' . $data['name'];
        $notifications->id_usuario = 1;
        $notifications->tipo = 0;
        $notifications->save();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ])->assignRole('usuario');
    }
}
