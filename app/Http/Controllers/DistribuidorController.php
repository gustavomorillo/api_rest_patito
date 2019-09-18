<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Validator;
use App\Distribuidor;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class DistribuidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){ 

        // Para el login se valida email y password, 
        // si son correctos se retorna el token para consumimir la API
        


        if(Auth::attempt(['email' => request('email'), 'password' => request('password')]) ){ 

            $distribuidor = Auth::user(); 
            $success['token'] = $distribuidor->api_token;
            return response()->json(['success' => $success]); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function index()
    {

         // Listo todas los distribuidores y devuelvo en formato JSON

        $distribuidores = Distribuidor::all();
        return response()->json($distribuidores);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
           // En esta funcion creo un distribuidor con email y password 
           
        // ademas de realizar las respectivas validaciones


        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:distribuidores'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if($validator->fails()){
            $response = array('response' =>$validator->messages(), 'success' => false);
            return $response;
        } else {
            $distribuidor = new Distribuidor;
            $distribuidor->email = $request->input('email');

            // Creo un token aleatorio de 60 caracteres para consumir la API
            $distribuidor->api_token = str_random(60);
            $distribuidor->password = Hash::make($request->input('password'));
            $distribuidor->save();
            return response()->json($distribuidor);
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

             // Funcion para actualizar los distribuidores, solo el campo de la contraseña es requerido

        $distribuidor = Auth::user();

        $validator = Validator::make($request->all(), [
            
            // Valido que el email no exista en la base de datos
            // valido que al ingresar el mismo email que tiene el distribuidor no se muestre que ya se encuentra registrado

            'email' => [
                'email','max:255',
                Rule::unique('distribuidores')->ignore($distribuidor->id),
            ],
            'password' => ['required', 'string', 'min:6'],
        ]);

        // Si falla la validacion se envia mensaje de error

        if($validator->fails()){
            $response = array('response' =>$validator->messages(), 'success' => false);
            return $response;
        } else {
            $distribuidor = Distribuidor::find($id);
            $distribuidor->email = $request->input('email');
            $distribuidor->api_token = str_random(60);
            $distribuidor->password = Hash::make($request->input('password'));
            $distribuidor->save();
            return response()->json($distribuidor);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          // Elimino el distribuidor especificando el ID del mismo


        $tarea = Distribuidor::find($id);
        $tarea->delete();
        $response = array('response' => 'Distribuidor Eliminado', 'success' => true);
            return $response;
    }
}
