<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([

            'nombre' => 'required|min:3|max:255',
            'apellido' => 'required|min:3|max:255',
            'correo' => 'required|email|max:255|unique:users',
            'password' => 'required|min:7|max:255',
        ], [
            'nombre.required' => 'El nombre es requerido',
            'apellido.required' => 'El nombre es requerido',
            'correo.required' => 'El correo es requerido',
            'password.required' => 'La contraseña es requerida',
        ]);

        $user = User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'tipo' => $request->tipo,
            'password' => Hash::make($request->password),
        ]);


        Auth::login($user);


        return redirect(RouteServiceProvider::HOME);
    }
}
