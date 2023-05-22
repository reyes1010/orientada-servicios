<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiLibrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $libros = Libro::all();
        return response()->json($libros);
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
            'TituloLibro' => 'required|regex:/^[a-zA-Z\s]+$/',
            'Autor' => 'required|regex:/^[a-zA-Z\s]+$/',
            'precio' => 'required'
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = $errors->all();
            return response()->json(['errors' => $messages], 422);
        }
    
        $libro = new Libro();
        $libro->fill($request->all());
        $libro->save();
    
        return response()->json([$libro], 201);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $libro = Libro::findOrFail($id);
        return response()->json($libro);

        
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
            'TituloLibro' => 'required|regex:/^[a-zA-Z\s]+$/',
            'Autor' => 'required|regex:/^[a-zA-Z\s]+$/',
            'precio' => 'required'
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = $errors->all();
            return response()->json(['errors' => $messages], 422);
        }
        
        $libro = Libro::findOrFail($id);
        $libro->fill($request->all());
        $libro->save();
        return response()->json($libro);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();
        $respuesta =[
            "mensaje" => "Libro eliminado"
        ];
        return response()->json($respuesta, 200);
    }
}
