<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PdfEnrollmentController extends Controller
{
    //


    public function forPrograma(Request $request)
    {
        $token = $request['token'];
        //$token = 'eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiI2ZGQ0ZTVkNi02ZjVhLTc1NDktNGIwNC0wMDAwM2U3YTczNTgiLCJzdWIiOiIxMjMxQTJDNS1BRUZGLTA2MjktRUE3QS0wMDAwNDgzNjJCNkIiLCJleHAiOjE3MTYyNTc3MTEsIm5iZiI6MTcxNjIxNDUxMiwiaWF0IjoxNzE2MjE0NTExLCJqdGkiOiJNVGN4TmpJeE5EVXhNUT09In0.JzUfzf2Zm1xk67bpi_m3L-h2DQtJVkuX4uUOYwzmv3-NmMGw_XCeuv2TtrlhrdgcgvrIQ63-YOT0SIwi39GIyg';
        try {
            // Obtener datos de puntuaciones
            /*
              {
                period_: 'post-2024-001',
                planId_: '9B81EBCF-1005-43A6-ADC5-9209B4CD2181',
                unit_: 'FEC985CC-C146-4C25-B6AC-12D9BD51A329'
            }
            */
            $url = "http://172.80.80.9/WORKLOAD_POSTGRADE/v1/course/byGroup/";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->post($url, [
                // 'period_' => 'post-2024-001',
                // 'planId_' => '9B81EBCF-1005-43A6-ADC5-9209B4CD2181',
                // 'unit_' => 'FEC985CC-C146-4C25-B6AC-12D9BD51A329'
                'period_' => $request['period_'],
                'planId_' => $request['planId_'],
                'unit_' => $request['unit_']
            ]);
            // dd($response);
            $datas = $response['data'];
            $listData = $datas[0];
            //  dd($listData);
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8', 'format' => 'A4-L',
                'margin_left' => 8,
                'margin_right' => 8,
                'margin_top' => 40,
                'margin_bottom' => 74,
            ]);
            $imgLogo = public_path('assets/images/logoPosGrado.png');
            $htmlHeader = view('pdfReportMatriculas.pdfPrograma._header', compact('imgLogo'))->render();

            $mpdf->SetHTMLHeader($htmlHeader, '0');

            $htmlFooter = view('pdfReportMatriculas.pdfPrograma._footer', compact('imgLogo'))->render();

            $mpdf->SetHTMLFooter($htmlFooter, '0');
            // Agregar contenido al PDF (puedes añadir tu contenido aquí)
            $html = view('pdfReportMatriculas.pdfPrograma.pdfPrograma', compact('listData'))->render();
            $mpdf->WriteHTML($html);
            // Nombre del archivo PDF generado
            // Salida del PDF como respuesta HTTP
            /// $mpdf->Output();
            $filename = 'report.pdf';
            return response()->streamDownload(function () use ($mpdf) {
                $mpdf->Output();
            }, $filename);
        } catch (\Exception $e) { // Especifica el tipo de excepción si es necesario
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function forSemestre(Request $request)
    {
        $token = $request['token'];
        try {
            // Obtener datos de puntuaciones
            /*
                  {
                    period_: 'post-2024-001',
                    planId_: '9B81EBCF-1005-43A6-ADC5-9209B4CD2181',
                    unit_: 'FEC985CC-C146-4C25-B6AC-12D9BD51A329'
                }
                */
            $url = "http://172.80.80.9/WORKLOAD_POSTGRADE/v1/student/byCycle/";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get($url . $request['period_'] . '/');
            $listData = $response['data'];
            // dd($listData);
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8', 'format' => 'A4-P',
                'margin_left' => 8,
                'margin_right' => 8,
                'margin_top' => 50,
                'margin_bottom' => 74,
            ]);
            $imgLogo = public_path('assets/images/logoPosGrado.png');
            $htmlHeader = view('pdfReportMatriculas.pdfSemestre._header', compact('imgLogo'))->render();

            $mpdf->SetHTMLHeader($htmlHeader, '0');

            $htmlFooter = view('pdfReportMatriculas.pdfSemestre._footer', compact('imgLogo'))->render();

            $mpdf->SetHTMLFooter($htmlFooter, '0');
            // Agregar contenido al PDF (puedes añadir tu contenido aquí)
            $html = view('pdfReportMatriculas.pdfSemestre.pdfSemestre', compact('listData'))->render();
            $mpdf->WriteHTML($html);
            // Nombre del archivo PDF generado
            // Salida del PDF como respuesta HTTP
            // $mpdf->Output();
            $filename = 'report.pdf';
            return response()->streamDownload(function () use ($mpdf) {
                $mpdf->Output();
            }, $filename);
        } catch (\Exception $e) { // Especifica el tipo de excepción si es necesario
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function forCurso(Request $request)
    {
        $token = $request['token'];
        try {
            // Obtener datos de puntuaciones
            /*
                  {
                    period_: 'post-2024-001',
                    planId_: '9B81EBCF-1005-43A6-ADC5-9209B4CD2181',
                    unit_: 'FEC985CC-C146-4C25-B6AC-12D9BD51A329'
                }
                */
            $url = "http://172.80.80.9/WORKLOAD_POSTGRADE/v1/student/byWorkload/";
            // dd($url .  $request['period_'].'/'.$request['workloadId'] . '/');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get($url .  $request['period_'] . '/' . $request['workloadId'] . '/');
            $datas = $response['data'];
            //dd($datas);
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8', 'format' => 'A4-P',
                'margin_left' => 8,
                'margin_right' => 8,
                'margin_top' => 50,
                'margin_bottom' => 74,
            ]);
            $imgLogo = public_path('assets/images/logoPosGrado.png');
            $htmlHeader = view('pdfReportMatriculas.pdfCourses._header', compact('imgLogo'))->render();

            $mpdf->SetHTMLHeader($htmlHeader, '0');

            $htmlFooter = view('pdfReportMatriculas.pdfCourses._footer', compact('imgLogo'))->render();

            $mpdf->SetHTMLFooter($htmlFooter, '0');
            // Agregar contenido al PDF (puedes añadir tu contenido aquí)
            $html = view('pdfReportMatriculas.pdfCourses.pdfCourses', compact('datas'))->render();
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

    public function forAnio(Request $request)
    {
        $token = $request['token'];
        try {
            // Obtener datos de puntuaciones
            /*
                  {
                    period_: 'post-2024-001',
                    planId_: '9B81EBCF-1005-43A6-ADC5-9209B4CD2181',
                    unit_: 'FEC985CC-C146-4C25-B6AC-12D9BD51A329'
                }
                */
            $url = "http://172.80.80.9/WORKLOAD_POSTGRADE/v1/student/byYear/";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get($url . $request['year'] . '/' . $request['programa'] . '/');

            $datas = $response['data'];
            //dd($datas);
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8', 'format' => 'A4-P',
                'margin_left' => 8,
                'margin_right' => 8,
                'margin_top' => 50,
                'margin_bottom' => 74,
            ]);
            $imgLogo = public_path('assets/images/logoPosGrado.png');
            $htmlHeader = view('pdfReportMatriculas.pdfAnio._header', compact('imgLogo'))->render();

            $mpdf->SetHTMLHeader($htmlHeader, '0');

            $htmlFooter = view('pdfReportMatriculas.pdfAnio._footer', compact('imgLogo'))->render();

            $mpdf->SetHTMLFooter($htmlFooter, '0');
            // Agregar contenido al PDF (puedes añadir tu contenido aquí)
            $html = view('pdfReportMatriculas.pdfAnio.pdfAnio', compact('datas'))->render();
            $mpdf->WriteHTML($html);
            // Nombre del archivo PDF generado
            // Salida del PDF como respuesta HTTP
            //$mpdf->Output();
            $filename = 'report.pdf';
            return response()->streamDownload(function () use ($mpdf) {
                $mpdf->Output();
            }, $filename);
        } catch (\Exception $e) { // Especifica el tipo de excepción si es necesario
            //http://172.80.80.9/WORKLOAD_POSTGRADE/v1/student/byYear/2023/065868E0-2AC1-4CD5-BDBE-6A046DB537C1/
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
