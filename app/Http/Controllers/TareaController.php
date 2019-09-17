<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tarea;
use Validator;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::all();
        return response()->json($tareas);
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
            'nombre' => 'required',
        ]);

        if($validator->fails()){
            $response = array('response' =>$validator->messages(), 'success' => false);
            return $response;
        } else {
            $tarea = new Tarea;
            $tarea->nombre = $request->input('nombre');
            $tarea->distribuidor_id = Auth::guard('api')->id();
            $tarea->save();

            return response()->json($tarea);
        }

       
    }
 // $nombre = $request->input('nombre');

        // return Tarea::create([
        //     'nombre' => $nombre,
        //     'distribuidor_id' => Auth::guard('api')->id()
        // ]);
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $tarea = Tarea::find($id);
        return response()->json($tarea);

    
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
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
        ]);

        if($validator->fails()){
            $response = array('response' =>$validator->messages(), 'success' => false);
            return $response;
        } else {
           
            $tarea = Tarea::find($id);
            $tarea->nombre = $request->input('nombre');
            $tarea->distribuidor_id = Auth::guard('api')->id();
            $tarea->save();

            return response()->json($tarea);
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
        $tarea = Tarea::find($id);
        $tarea->delete();
        $response = array('response' => 'Tarea Eliminada', 'success' => true);
        return $response;
    }
}
