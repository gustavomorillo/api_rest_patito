<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Tarea;
use Validator;
use Carbon\Carbon;
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
        
        
           // En esta funcion creo una tarea con todos sus atributos 
        // ademas de realizar las respectivas validaciones


        $validator = Validator::make($request->all(), [
            
            
            'nombre' => ['required', 'string', 'min:6', 'max:255'],
            'direccion' => ['required', 'string', 'max:255'],

            'latitud' => ['required', 'integer'],
            'longitud' => ['required', 'integer'],

            'mercancia' => ['required', 'integer'],
            'estado' => ['required', 'string', 'max:255'],
        ]);


        $date = new Carbon();

        if($validator->fails()){
            $response = array('response' =>$validator->messages(), 'success' => false);
            return $response;
        } else {
            $tarea = new Tarea;
            $tarea->fecha = $date;
            $tarea->nombre = $request->input('nombre');
            $tarea->direccion = $request->input('direccion');
            $tarea->latitud = $request->input('latitud');
            $tarea->longitud = $request->input('longitud');
            $tarea->mercancia = $request->input('mercancia');
            $tarea->estado = $request->input('estado');
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
            
            'nombre' => ['string', 'min:6', 'max:255'],
            'direccion' => ['string', 'max:255'],

            'latitud' => ['integer'],
            'longitud' => ['integer'],

            'mercancia' => ['integer'],
            'estado' => ['string', 'max:255'],

        ]);

        if($validator->fails()){
            $response = array('response' =>$validator->messages(), 'success' => false);
            return $response;
        } else {
           
            $tarea = Tarea::find($id);

            if($request->input('nombre')){
                $tarea->nombre = $request->input('nombre');
            }
            if($request->input('direccion')){
                $tarea->direccion = $request->input('direccion');
            }
            if($request->input('latitud')){
                $tarea->latitud = $request->input('latitud');
            }
            if($request->input('longitud')){
                $tarea->longitud = $request->input('longitud');
            }
            if($request->input('mercancia')){
                $tarea->mercancia = $request->input('mercancia');
            }
            if($request->input('estado')){
                $tarea->estado = $request->input('estado');
            }
            
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
