<?php
namespace Network\SatService;

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


           /* $respuesta = [
               $datosEntidadxNit                
            ];*/

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

        //Conversión de xml a un json
        $response = [
                'nit' => $nit_2[0],
                'razon_social' => $razonSocialPublica,
                'direccion' => $direcCllAve_1[0]." ".$numCasaApto." ZONA ". $direcZona_1[0] ." ".$direcColo_1[0],
                'email' => $email_1[0],
                'telefono' => $telefono_1[0]
        ];

        return $response ;
    }



}
