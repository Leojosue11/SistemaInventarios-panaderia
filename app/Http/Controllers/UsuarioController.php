<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Usuarios = DB::table('users')
            ->join('rols', 'users.RolId', '=', 'rols.IdRol')
            ->select(
                'users.name',
                'users.email',
                'users.password',
                'rols.NombreRol',
                'rols.IdRol'
            )

            ->get();
        return $Usuarios;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Guarda el usuario
    public function store(Request $request)
    {

        $Mensajes = [
            'required' => 'El :attribute es requerido',
            'unique' => 'El campo :attribute ya existe en la base',
            'email' => 'El email debe ser valido'
        ];

        $validaciones = validator::make($request->all(), [

            'name' => 'required|max:50|unique:users',
            'email' => 'required',
            'RolId' => 'required',
            'password' => 'required'
        ], $Mensajes);

        if ($validaciones->fails()) {
            $errores = $validaciones->errors();
            return response()->json($errores, 402);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'RolId' => $request->RolId,
                'password' => bcrypt($request->password)
            ]);
            $token = $user->createToken('Personal Acces Token')->accessToken;
            return response()->json(['token' => $token]);
        }
    }


    public function login(Request $request)
    {

       /* $request->validate([
            'name' => 'required',
            'password' => 'required'


        ]);*/

        $Mensajes = [
            'required' => 'El :attribute es requerido',
           
        ];
        $msj = validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required'
        ], $Mensajes);

        if ($msj->fails()) {
            $errores = $msj->errors();
            return response()->json($errores, 401);
        }

        $credentials = request(['name', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Usuario o Contraseña invalida'
            ], 401);
        }

        $user = $request->user();

        $token = $user->createToken('Access Token');

        $user->access_token = $token->accessToken;

        return response()->json([
            "user" => $user, 'success' => true,
        ], 200);
    }


    

    public function logout(Request $request)
    {
        $user = $request->user();

        foreach ($user->tokens as $token) {
            $token->revoke();
        } return response()->json([
            'success' => true,

            'message' => 'Session Cerrada'
        ]);
        Auth::logout();

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
