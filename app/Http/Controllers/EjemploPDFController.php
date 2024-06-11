<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EjemploPDFController extends Controller
{
    //

    public function ejemploPDF(Request $request)
    {
        $datas = [
            [
                'studentCode' => '232695',
                'lastName1' => 'TORRES',
                'lastName2' => 'YUCRA',
                'name' => 'RUTH LUCIA'
            ],
            [
                'studentCode' => '232468',
                'lastName1' => 'SUCARI',
                'lastName2' => 'TURPO',
                'name' => 'WILSON GREGORIO'
            ],
            // ... (otros estudiantes)
            [
                'studentCode' => '232567',
                'lastName1' => 'ZUÑIGA',
                'lastName2' => 'VALDEZ',
                'name' => 'LARRY RENATO'
            ]
        ];
        try {
            //dd($datas);
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8', 'format' => 'A4-P',
                'margin_left' => 8,
                'margin_right' => 8,
                'margin_top' => 50, //define el tamaño del header 
                'margin_bottom' => 74, //define el tamaño del footer 
            ]);
            //
            $imgLogo = public_path('assets/images/logoPosGrado.png');
            $htmlHeader = view('ejemploPDF._header', compact('imgLogo'))->render();

            $mpdf->SetHTMLHeader($htmlHeader, '0');

            $htmlFooter = view('ejemploPDF._footer', compact('imgLogo'))->render();

            $mpdf->SetHTMLFooter($htmlFooter, '0');
            // Agregar contenido al PDF (puedes añadir tu contenido aquí)
            $html = view('ejemploPDF.ejemploPDF', compact('datas'))->render();
            $mpdf->WriteHTML($html);
            // Nombre del archivo PDF generado
            // Salida del PDF como respuesta HTTP
            $filename = 'report.pdf';
            return response()->streamDownload(function () use ($mpdf) {
                $mpdf->Output();
            }, $filename);
            //$mpdf->Output();
        } catch (\Exception $e) { // Especifica el tipo de excepción si es necesario
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
