<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Usuarios = DB::table('usuarios')
            ->join('rols', 'usuarios.RolId', '=', 'rols.IdRol')
            ->select(
               'usuarios.NombreUsuario',
               'usuarios.EmailUsuario',
               'usuarios.NombreUsuario',
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
    public function store(Request $request)
    {
        // Usuario::Create($request->all());
        $Mensajes = [ 'required' => 'El :attribute es requerido',
                    'unique' => 'El campo :attribute ya existe en la base',
                    'email' => 'El email debe ser valido'
        ];
        
        $validaciones = validator::make($request->all(),[
            //unique:nombredelatabla
            'NombreUsuario' => 'required|max:50|unique:usuarios',
            'EmailUsuario' => 'required|email',
            'RolId' => 'required',
            'Password' => 'required'
        ],$Mensajes);

        if ($validaciones->fails()){
            $errores = $validaciones->errors();

            return response()-> json($errores, 402);
        }else{
             $usuarios = Usuario::create($request->all());
            return '{"msg":"creado","result":' . $usuarios . '}';
        };
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
