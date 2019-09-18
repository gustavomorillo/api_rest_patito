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

        $distribuidor = Auth::user();

        $validator = Validator::make($request->all(), [
            

            'email' => [
                'email','max:255',
                Rule::unique('distribuidores')->ignore($distribuidor->id),
            ],


            'password' => ['required', 'string', 'min:6'],
        ]);

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
        $tarea = Distribuidor::find($id);
        $tarea->delete();
        $response = array('response' => 'Distribuidor Eliminado', 'success' => true);
            return $response;
    }
}
