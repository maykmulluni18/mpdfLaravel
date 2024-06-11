<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    //public function getData($token, $idPeriodo, $data){
    // public function getData($token, $idPeriodo, $worloadId)
    // {
    //     $url = "http://172.80.80.9/PUNCTUATIONS_POSTGRADE/v1/score/sheet/";
    //     try {
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . $token,
    //             'Accept' => 'application/json',

    //         ])->get($url . $idPeriodo . '/' . $worloadId . '/');

    //         $responseData = $response['data'];
    //         return $responseData;
    //     } catch (RequestException $e) {
    //         Log::error('Error al hacer la solicitud HTTP: ' . $e->getMessage());
    //         return $e->getMessage(); // Devuelve null o algún valor predeterminado en caso de error
    //     } catch (\Exception $e) {
    //         Log::error('Error: ' . $e->getMessage());
    //         return $e->getMessage(); // Devuelve null o algún valor predeterminado en caso de error
    //     }
    // }
    // public function getFaculity($token, $idPeriodo, $worloadId)
    // {
    //     $url = 'http://172.80.80.9/WORKLOAD_POSTGRADE/v1/academical/structure/';
    //     try {
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . $token,
    //             'Accept' => 'application/json',

    //         ])->get($url . $idPeriodo . '/' . $worloadId . '/');

    //         $responseData = $response['data'];
    //         return $responseData;
    //     } catch (RequestException $e) {
    //         Log::error('Error al hacer la solicitud HTTP: ' . $e->getMessage());
    //         return null; // Devuelve null o algún valor predeterminado en caso de error
    //     } catch (\Exception $e) {
    //         Log::error('Error: ' . $e->getMessage());
    //         return null; // Devuelve null o algún valor predeterminado en caso de error
    //     }
    // }
    // public function getDetailsCourse($token, $idPeriodo, $worloadId)
    // {
    //     $url = 'http://172.80.80.9/WORKLOAD_POSTGRADE/v1/information/';
    //     try {
    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . $token,
    //             'Accept' => 'application/json',

    //         ])->get($url . $idPeriodo . '/' . $worloadId . '/');

    //         $responseData = $response['data'];
    //         return $responseData;
    //     } catch (RequestException $e) {
    //         Log::error('Error al hacer la solicitud HTTP: ' . $e->getMessage());
    //         return null; // Devuelve null o algún valor predeterminado en caso de error
    //     } catch (\Exception $e) {
    //         Log::error('Error: ' . $e->getMessage());
    //         return null; // Devuelve null o algún valor predeterminado en caso de error
    //     }
    // }


    public function generatePDF(Request $request)
    {
        //print('hola');
        //die();
        $token = $request['token'];
        try {

            // Obtener datos de puntuaciones
            $urlPuntuaciones = "http://172.80.80.9/PUNCTUATIONS_POSTGRADE/v1/score/sheet/";
            $responsePuntuaciones = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get($urlPuntuaciones . $request['idPeriodo'] . '/' . $request['worloadId'] . '/');
            $datas = $responsePuntuaciones['data'];

            // Obtener datos de facultad
            $urlFacultad = 'http://172.80.80.9/WORKLOAD_POSTGRADE/v1/academical/structure/';
            $responseFacultad = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get($urlFacultad . $request['idPeriodo'] . '/' . $request['worloadId'] . '/');
            $faculity = $responseFacultad['data'];

            // Obtener detalles del curso
            $urlDetallesCurso = 'http://172.80.80.9/WORKLOAD_POSTGRADE/v1/information/';
            $responseDetallesCurso = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get($urlDetallesCurso . $request['idPeriodo'] . '/' . $request['worloadId'] . '/');
            $dataCoureses = $responseDetallesCurso['data'];

            // dd($dataCoureses);
            foreach ($datas as &$data) {
                // Verifica si 'punctuation' está vacío
                if (empty($data['punctuation'])) {
                    // Si está vacío, crea un array con los elementos requeridos
                    $data['punctuation'] = array(
                        array('type' => '001', 'score' => '-'),
                        array('type' => '002', 'score' => '-'),
                        array('type' => '003', 'score' => '-'),
                        array('type' => '005', 'score' => '-'),
                        array('type' => '005_1', 'score' => '-'),
                    );
                } else {
                    // Si no está vacío, verifica si faltan elementos y agrégalos
                    $existingTypes = array_column($data['punctuation'], 'type');
                    $requiredTypes = array('001', '002', '003', '005', '005_1');

                    // Agrega los elementos faltantes
                    foreach ($requiredTypes as $type) {
                        if (!in_array($type, $existingTypes)) {
                            $data['punctuation'][] = array('type' => $type, 'score' => '-');
                        }
                    }

                    // Ordena los elementos por 'type'
                    usort($data['punctuation'], function ($a, $b) {
                        return strcmp($a['type'], $b['type']);
                    });

                    // Convierte el puntaje en letras si el tipo es '005'
                    foreach ($data['punctuation'] as &$score) {
                        if ($score['type'] === '005_1') {
                            $score['score'] = $this->scoreToWords($data['punctuation'][3]['score']); // Index 3 es '005'
                        }
                    }
                    unset($score);
                }
            }

            // Liberar la referencia
            unset($data);


            $dataCourese = $dataCoureses[0];
            $fileNameReport = $dataCourese['professorSurname'] . ' - ' . $dataCourese['professorSurnameM'] . ' - ' . $dataCourese['professorName'] . ' - [' . $dataCourese['courseName'] . ']';

            // Crea un objeto de renderizado de imagen PNG
            $renderer = new Png();

            // Configura el tamaño de la imagen
            $renderer->setWidth(300);
            $renderer->setHeight(300);

            // Crea un objeto de escritura y genera el código QR
            $writer = new Writer($renderer);

            $qrCode = $writer->writeString("hola mundo");

            // dd($datas);
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8', 'format' => 'A4-P',
                'margin_left' => 8,
                'margin_right' => 8,
                'setAutoTopMargin' => 'stretch',
                'autoMarginPadding' => -25,
                'setAutoBottomMargin' => 'pad',

                // 'margin_top' => 65,
                //
                'margin_bottom' => 74,
            ]);
            // Agregar cabezera al PDF
            //imagen
            // Definir placeholders para el header y footer

            $imgLogo = public_path('assets/images/logoPosGrado.png');
            $htmlHeader = view('pdfActas._header', compact('imgLogo', 'faculity', 'dataCourese'))->render();

            $mpdf->SetHTMLHeader($htmlHeader);
            // $mpdf->setAutoTopMargin = 'pad'; // Opciones posibles: 'pad' (predeterminado), 'stretch', false

            $htmlFooter = view('pdfActas._footer', compact('imgLogo'))->render();

            $mpdf->SetHTMLFooter($htmlFooter);
            // Agregar contenido al PDF (puedes añadir tu contenido aquí)
            $html = view('pdfActas.pdfActas', compact('datas',  'qrCode'))->render();
            $mpdf->WriteHTML($html);
            // Nombre del archivo PDF generado
            $filename = $fileNameReport . '.pdf';
            // Salida del PDF como respuesta HTTP
            #return $mpdf->Output($filename, 'I');
            #salida
            return response()->streamDownload(function () use ($mpdf) {
                $mpdf->Output();
            }, $filename);
            // $mpdf->Output('file.pdf', 'D'); // 'D' indica descarga
            // $response = [
            //     'success' => true,
            //     'message' => 'PDF generado correctamente.'
            // ];
        } catch (\Exception $e) {
            // Captura cualquier excepción y construye un mensaje de error en formato JSON
            $response = [
                'success' => false,
                'message' => 'Error al generar el PDF: ' . $e->getMessage()
            ];
        }

        // Devolver el mensaje en formato JSON
        return response()->json($response);
    }



    // Función para convertir el score numérico a letras
    function scoreToWords($score)
    {
        $ones = array(
            0 => 'cero', 1 => 'uno', 2 => 'dos', 3 => 'tres', 4 => 'cuatro', 5 => 'cinco',
            6 => 'seis', 7 => 'siete', 8 => 'ocho', 9 => 'nueve', 10 => 'diez',
            11 => 'once', 12 => 'doce', 13 => 'trece', 14 => 'catorce', 15 => 'quince',
            16 => 'dieciséis', 17 => 'diecisiete', 18 => 'dieciocho', 19 => 'diecinueve'
        );

        $tens = array(
            2 => 'veinte', 3 => 'treinta', 4 => 'cuarenta', 5 => 'cincuenta',
            6 => 'sesenta', 7 => 'setenta', 8 => 'ochenta', 9 => 'noventa'
        );

        if ($score >= 0 && $score <= 19) {
            return $ones[$score];
        } elseif ($score >= 20 && $score <= 99) {
            $ten = floor($score / 10);
            $one = $score % 10;
            if ($one == 0) {
                return $tens[$ten];
            } else {
                return $tens[$ten] . ' y ' . $ones[$one];
            }
        } else {
            return '-';
        }
    }
}
