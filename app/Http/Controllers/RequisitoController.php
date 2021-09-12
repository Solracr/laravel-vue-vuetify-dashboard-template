<?php

namespace App\Http\Controllers;

use App\Models\Requisito;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class RequisitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        return Requisito::where('user_id', auth()->id())->get();   
    
    }
                      

    public function upload(Request $request)
    {
        $expediente = Solicitud::where('user_id', auth()->id())->latest()->first()->expediente;
        $id = Solicitud::where('user_id', auth()->id())->latest()->first()->id;                
        if($request->file_1 != null){
            $fileName = 'f1-'.time().$expediente.'.'.$request->file_1->getClientOriginalExtension();
            $request->file_1->move(public_path('upload'), $fileName);  
            //create
            Requisito::insert(
                ['descripcion' => 'Representación Legal', 'archivo' => $fileName, 'expediente' => $expediente, 'solicitud_id' => $id, 'user_id' =>auth()->id() ]
            );            
        }
        if($request->file_2 != null){
            $fileName = 'f2-'.time().$expediente.'.'.$request->file_2->getClientOriginalExtension();
            $request->file_2->move(public_path('upload'), $fileName);                  
            Requisito::insert(
                ['descripcion' => 'Pasaporte Autenticado', 'archivo' => $fileName, 'expediente' => $expediente, 'solicitud_id' => $id, 'user_id' =>auth()->id() ]
            );            
        }
        if($request->file_3 != null){
            $fileName = 'f3-'.time().$expediente.'.'.$request->file_3->getClientOriginalExtension();
            $request->file_3->move(public_path('upload'), $fileName);                  

            Requisito::insert(
                ['descripcion' => 'Fotocopia autenticada situación migratoria', 'archivo' => $fileName, 'expediente' => $expediente, 'solicitud_id' => $id, 'user_id' =>auth()->id() ]
            );            
        }
        if($request->file_f4 != null){
            $fileName = 'f4-'.time().$expediente.'.'.$request->file_4->getClientOriginalExtension();
            $request->file_4->move(public_path('upload'), $fileName);                  
            Requisito::insert(
                ['descripcion' => 'Acta Notarial', 'archivo' => $fileName, 'expediente' => $expediente, 'solicitud_id' => $id, 'user_id' =>auth()->id() ]
            );            
        }
        if($request->file_5 != null){
            $fileName = 'f5-'.time().$expediente.'.'.$request->file_5->getClientOriginalExtension();
            $request->file_5->move(public_path('upload'), $fileName);                              
            Requisito::insert(
                ['descripcion' => 'Certificación Contable', 'archivo' => $fileName, 'expediente' => $expediente, 'solicitud_id' => $id, 'user_id' =>auth()->id() ]
            );            
        }
        if($request->file_6 != null){
            $fileName = 'f6-'.time().$expediente.'.'.$request->file_6->getClientOriginalExtension();
            $request->file_6->move(public_path('upload'), $fileName);                  
            Requisito::insert(
                ['descripcion' => 'Fotocopia autenticada del nombramiento del extranjero', 'archivo' => $fileName, 'expediente' => $expediente, 'solicitud_id' => $id, 'user_id' =>auth()->id() ]
            );            
            //Fotocopia autenticada del nombramiento del extranjero
        }
        if($request->file_7 != null){
            //Declaracion Jurada
            $fileName = 'f7-'.time().$expediente.'.'.$request->file_7->getClientOriginalExtension();
            $request->file_7->move(public_path('upload'), $fileName);                  
            Requisito::insert(
                ['descripcion' => 'Declaración Jurada', 'archivo' => $fileName, 'expediente' => $expediente, 'solicitud_id' => $id, 'user_id' =>auth()->id() ]
            );                        
        }
        

        //Empresa::where('user_id', auth()->id())->get();   
     
        
        return response()->json(['success'=>'Archivo Cargado exitosamente!!']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function show(Requisito $requisito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisito $requisito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisito $requisito)
    {
        //
    }
}
