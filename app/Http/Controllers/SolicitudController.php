<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\Nacionalidad;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Idioma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use PDF;
use QrCode;
use Uuid;



class SolicitudController extends Controller
{

    public function index(Request $request)
    {
        return Solicitud::where('user_id', auth()->id())->get();   
    
    }

    public function nacionalidades()
    {
        return Nacionalidad::all();           
    }

    public function departamentos()
    {
        return Departamento::all();           
    }


    public function idiomas()
    {        
        return Idioma::select('IDIOMA')->pluck('IDIOMA')->toArray();        
    }


    public function municipios(Request $request)
    {
        $datosSolicitud = $request;        
        return Municipio::where('departamento_id', $datosSolicitud['departamento'])->get();            
    }

    public function store(Request $request)
    {
//pendiente CSRF para token ya esta implementando en el otro componente
        $datosSolicitud = $request;                
        $datosSolicitud['user_id'] = auth()->id();
        $datosSolicitud['periodo'] = date("Y");
        $ahora = date("Y-m-d H:i:s");        
        $nombreDepartamento = Departamento::where('codigo',$datosSolicitud['departamento'])->first();        
        $ndep= $nombreDepartamento->nombre;

        $nombreMunicipio = Municipio::where('codigo',$datosSolicitud['municipio'])->first();
        $nmun = $nombreMunicipio->nombre;

        
        $today = date("Y-m-d");
        $diff = date_diff(date_create($datosSolicitud['fechaNacimiento']), date_create($today));
        $edad = $diff->format('%y');

        $ctn_expedientes = Solicitud::where('tipo1','=', $datosSolicitud['tipo1'])
                                      ->where('tipo2','=', $datosSolicitud['tipo2'])
                                      ->where('periodo','=', $datosSolicitud['periodo'])->count();
        //PEX-D-1-2021
        $ctn_expedientes = $ctn_expedientes + 1;
        $expediente = 'PEX-D-'.$ctn_expedientes.'-'.date("Y");
        $datosSolicitud['expediente'] = $expediente;

        $ext = ".svg";        
        $qrCode  = Uuid::generate()->string;
        $qr_certificacion = 'pdf/'.$qrCode.'.pdf';
        $datosSolicitud['qr'] = $qr_certificacion;
        $record = Solicitud::create($datosSolicitud->all());
        $nombreCompleto = $datosSolicitud['primerNombre'].' '.$datosSolicitud['otrosNombres'].' '.$datosSolicitud['primerApellido'].' '.$datosSolicitud['otrosApellidos'].' '.$datosSolicitud['apellidoCasada'];                
         $data = [
             'title' => 'Certificacion',
             'date' => date('d/m/Y'),
             'expediente' => $qrCode.$ext
         ]; 
         //quitar URL kali
         $url = "https://pex.mintrabajo.gob.gt/certificacion/";    
         
         
         QrCode::generate($url.$qrCode, public_path('/img/qr/'.$qrCode.$ext) );       

         $pdf = App::make('dompdf.wrapper');         
         $svg_ = 'img/qr'.'/'.$qrCode.$ext;        
         $logo_ = 'img/logo.png';        
         $pdf->loadHTML('<html>

         <head>
         <title>Constancia de Permiso de Trabajo Extranjero '.$expediente.'</title>
         </head>
         <body>
         <style>
         .demo {
             width:100%;
             border:1px solid #C0C0C0;
             border-collapse:collapse;
             padding:5px;
         }
         .demo th {
             border:1px solid #FFFFFF;
             padding:5px;
         }
         .demo td {
             border:1px solid #FFFFFF;
             padding:5px;
             background:#F0F0F0;
         }
     </style>

         <table class="demo" ">
         <tbody>
         <tr >
         <th  colspan="4">&nbsp;&nbsp;  <img src="'.$logo_.'" alt="Logo"></th>
        
         </tr>
         <tr >
         <td colspan="4" >&nbsp;</td>         
         </tr>
         <tr >
         <td  colspan="4"><b>NUEVA SOLICITUD PERMISOS EXTRANJEROS PARA LABORAR EN EMPRESA GUATEMALTECA&nbsp;</b></td>
         </tr>
         <tr >
         <td >&nbsp;<b>Expediente:</b></td>
         <td >&nbsp;'.$expediente.'</td>
         <td ><b>PTE-FO-20-2</b></td>
         <td >&nbsp;</td>
         </tr>
         <tr >
         <td >&nbsp;<b>Tipo Solicitud:</b></td>
         <td >Permiso Nuevo</td>
         <td >&nbsp;<b>Fecha de Emisi&oacute;n:</b></td>
         <td >&nbsp;<p><small>'.$ahora.'</small></p></td>
         </tr>
         <tr >
         <td colspan="4"  >&nbsp;</td>         
         </tr>
         <tr >
         <td >&nbsp;<b>Nombre Completo:</b></td>
         <td >&nbsp;'.$nombreCompleto.'</td>
         <td ><b>Estado Civil:</b></td>
         <td >&nbsp;'.$datosSolicitud['estadoCivil'].'</td>
         </tr>
         <tr >
         <td ><b>Sexo:</b></td>
         <td >&nbsp;'.$datosSolicitud['genero'].'</td>
         <td ><b>Tel&eacute;fono:</b></td>
         <td >&nbsp;'.$datosSolicitud['numeroTelefono'].'</td>
         </tr>
         <tr >
         <td ><b>Departamento Residencia:</b></td>
         <td >&nbsp;'.$ndep.'</td>
         <td ><b>Municipio Residencia:</b></td>
         <td >&nbsp;'.$nmun.'</td>
         </tr>
         <tr >
         <td ><b>Fecha nacimiento:</b></td>
         <td >&nbsp;'.$datosSolicitud['fechaNacimiento'].'</td>
         <td ><b>Edad:</b></td>
         <td >&nbsp;'.$edad.'</td>
         </tr>
         <tr >
         <td ><b>DPI:</b></td>
         <td >&nbsp;'.$datosSolicitud['numeroDocumento'].'</td>
         <td ><b>Nacionalidad:</b></td>
         <td >&nbsp;'.$datosSolicitud['nacionalidad'].'</td>
         </tr>
         <tr >
         <td ><b>Profesi&oacute;n:</b></td>
         <td >&nbsp;'.$datosSolicitud['profesion'].'</td>
         <td ><b>Correo:</b></td>
         <td >&nbsp;'.$datosSolicitud['correoElectronico'].'</td>
         </tr>
         </tbody>
         </table>
         <br>
         <br>
         <br>
         
         UUID: '. $qrCode.'

         <br>
         <br>
         <img src="'.$svg_.'" alt="QR Code">
         
         
         </body>
         </html>');

     

         $path = public_path('/pdf');         
         $fileName =  $qrCode.'.'.'pdf' ;         
         $pdf->save($path . '/' . $fileName);  
         //return $record->expediente;                
         return $record->id;                
    }

 
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    public function destroy(Solicitud $solicitud)
    {
        //
    }
}
