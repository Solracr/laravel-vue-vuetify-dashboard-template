<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use QrCode;
use Uuid;

class PDFController extends Controller
{
     //
     public function generatePDF()
     {
        $ext = ".svg";        
        $expedienteCode  = Uuid::generate()->string;
         $data = [
             'title' => 'Welcome to ItSolutionStuff.com',
             'date' => date('d/m/Y'),
             'expediente' => $expedienteCode.$ext
         ];                        
         QrCode::generate($expedienteCode, public_path('/img/qr/'.$expedienteCode.$ext) );

         //*******************WORKS WELLL ********************** */
         /*$pdf = PDF::loadView('pdf/constancia', $data);
         return $pdf->download('constanciaSolicitudPermisos.pdf');*/
         //*******************WORKS WELLL ********************** */

         /*$qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string654654654a65sfd4a65sd4f65as4df65as4df65a4sd65f4as65df4a65sd4fa65sd4f65a4sd'));
         $pdf = PDF::loadView('pdf/constancia', compact('qrcode','data'));
         return $pdf->stream();*/
         
         //$pdf = PDF::loadView('pdf/constancia', $qrcode, ['data'=>$data]);
         //$pdf = PDF::loadView('templatePdf', ['player'=>$player]);
         
     
         $pdf = PDF::loadView('pdf/constancia', $data);

         $path = public_path('pdf/');
         $fileName =  $expedienteCode.'.'.'pdf' ;
         $pdf->save($path . '/' . $fileName);

         //insertar qr en bd

         //Storage::put('public/pdf/'.$expedienteCode.'.pdf', $pdf->output());
         return view('bandeja.index');
        //codigo para grabar antes de descargar
         /*
            $pdf = PDF::loadView('pdf/constancia', $data);
            Storage::put('public/pdf/invoice.pdf', $pdf->output());
            return $pdf->download('invoice.pdf');
         */ 
     }
}
