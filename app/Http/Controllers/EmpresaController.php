<?php

namespace App\Http\Controllers;
use App\Models\Empresa;
use Illuminate\Http\Request;



class EmpresaController extends Controller
{
    public function listadoEmpresas(Request $received_data)
    {
        return Empresa::where('user_id', auth()->id())->get();        
    }


    public function registrarEmpresa(Request $request)
    {
        $datosSolicitud = $request;
        $datosSolicitud['user_id'] = auth()->id();
        $record = Empresa::create($datosSolicitud->all());
        return $record->id;        
    }

    public function webserviceSat(Request $request){
        $datos = $request->except('_token');        
        $nitRequest = $datos['nit'];        
        //$nitRequest = $request->nit;                                           
        $service = new SatSearchNit();
        $result  = $service->searchNit($nitRequest);     
        return $result;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

  
    public function show(Empresa $empresa)
    {
        //
    }

   
    public function edit(Empresa $empresa)
    {
        //
    }


    public function update(Request $request, Empresa $empresa)
    {
        //
    }

  
    public function destroy(Empresa $empresa)
    {
        //
    }
}


use PhproTest\SoapClient;

class SatSearchNit
{
    private $urlProd, $satPass, $satUser;

    public function __construct()
    {
        $this->urlProd =  env("SAT_WS_WSDL_DEV");
        $this->satPass = env("PWD_SAT");
        $this->satUser = env("USER_SAT");

    }


    public function searchNit($nit)
    {

        try {

            $urlProd = $this->urlProd;

            $response = new \SoapClient($urlProd);
            $usuarioSat = $this->satUser;
            $claveSat   =  $this->satPass;
            $datos = [$usuarioSat, $claveSat, $nit];
            
            
            $response->__soapCall('findContribuyenteByNitGC', $datos);
      
            $datosEntidadxNit = $this->convertDataNit($response->__soapCall('findContribuyenteByNitGC', $datos));
            
            $respuesta = [
                'code' => 200,
                'contribuyente' => $datosEntidadxNit
                
            ];

            return response()->json($respuesta);
        }catch (\Throwable $e){

            $error = [
                'code' => 300,
                'mensaje' => "Error al consultar: ".$e
            ];
            return response()->json($error);
        }
    }


    private function convertDataNit($dataResult){
        $data = $dataResult;

        $nit_1              = explode('<NIT>', $data);
        $nit_2              = explode('</NIT>', $nit_1[1]);
        $razonSocial        = explode('<NOM><![CDATA[',$data);
        $razonSocial_1      = explode(']]></NOM>',$razonSocial[1]);
        $razonSocialInd     = explode(',',$razonSocial_1[0]);
        $direcCllAve        = explode('<DOM_FIS><COA><![CDATA[',$data);
        $direcCllAve_1      = explode(']]></COA>', $direcCllAve[1]);
        $direcNumCasa       = explode('<NC>',$data);
        $direcNumCasa_1     = explode('</NC>', $direcNumCasa[1]);
        $direcApto          = explode('<APA><![CDATA[', $data);
        $direcApto_1        = explode(']]></APA>', $direcApto[1]);
        $direcZona          = explode('<ZON>',$data);
        $direcZona_1        = explode('</ZON>',$direcZona[1]);
        $direcColo          = explode('<COL><![CDATA[', $data);
        $direcColo_1        = explode(']]></COL>', $direcColo[1]);
        $email              = explode('<EMA><![CDATA[', $data);
        $email_1            = explode(']]></EMA>', $email[1]);
        $telefono           = explode('<TEL>', $data);
        $telefono_1         = explode('</TEL>', $telefono[1]);
        $actividad          = explode('<AECONOMICA><![CDATA[', $data);
        $actividad_1        = explode(']]></AECONOMICA>', $actividad[1]);
        $replegal           = explode("<REP TIPO='0'>", $data);
        $replegal_1         = explode('</REP>', $replegal[1]);
        $nit_rep            = explode('<NIT>', $replegal_1[0]);
        $nit_rep_1          = explode('</NIT>', $nit_rep[1]);
        $nom_rep            = explode('<NOM><![CDATA[', $replegal_1[0]);
        $nom_rep_1          = explode(']]></NOM>', $nom_rep[1]);
        $replegal           = explode(',',$nom_rep_1[0]);
        
        $numCasaApto = $direcNumCasa_1[0] === ' ' ?  "APTO/CASA ".$direcApto_1[0]: $direcNumCasa_1[0];

        $conteo = sizeof($razonSocialInd);
        $razonSocialPublica = '';
        switch ($conteo){
            case 1:
                $razonSocialPublica = $razonSocial_1[0];
                break;
            case 2:
                $razonSocialPublica = $razonSocialInd[0].','.$razonSocialInd[1] ;
                break;
            case 3:
            case 4:
            case 5:
                $razonSocialPublica = $razonSocialInd[3].' '.$razonSocialInd[4].' '.$razonSocialInd[0].' '.$razonSocialInd[1];
                break;
        }




        $conteo = sizeof($replegal);   
        $nomrep1 =  "";
        $nomrep2 =  "";
        $nomrep3 =  "";
        $nomrep4 =  "";
        switch ($conteo){
            case 1:
                $nomrep1 = $replegal[0];
                break;
            case 2:
                $nomrep1 = $replegal[0]; $nomrep2 = $replegal[1] ;
                break;
            case 3:
            case 4:
            case 5:
                $nomrep4 = $replegal[0]; $nomrep3 = $replegal[1] ;
                $nomrep1 = $replegal[3]; $nomrep2 = $replegal[4] ;               
                break;
        }

        $response = [
                'nit' => $nit_2[0],
                'razonSocial' => $razonSocialPublica,
                'domicilio' => $direcCllAve_1[0]." ".$numCasaApto." ZONA ". $direcZona_1[0] ." ".$direcColo_1[0],
                'correo' => $email_1[0],
                'telefono' => $telefono_1[0],
                'actividadEconomica' => $actividad_1[0],
                'nitRepresentante' => $nit_rep_1[0],
                'primerNombreRepresentante' => $nomrep1, 
                'otrosNombresRepresentante' => $nomrep2, 
                'primerApellidoRepresentante' => $nomrep3, 
                'segundoApellidoRepresentante' => $nomrep4,
                'direccionNotificaciones' => $direcCllAve_1[0]." ".$numCasaApto." ZONA ". $direcZona_1[0] ." ".$direcColo_1[0]
        ];
        
        return $response ;
    }



}

