<?php

namespace App\Http\Controllers;

use App\Exports\ReportXlsx;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class ReportXlsxController extends Controller
{
    public function xlsxByGroup(Request $request){

        # Define el endpoint y el token
        $url = 'http://172.80.80.9/WORKLOAD_POSTGRADE/v1/course/byGroup/';

        #$token = 'eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiI2ZGQ0ZTVkNi02ZjVhLTc1NDktNGIwNC0wMDAwM2U3YTczNTgiLCJzdWIiOiIxMjMxQTJDNS1BRUZGLTA2MjktRUE3QS0wMDAwNDgzNjJCNkIiLCJleHAiOjE3MTU3MzgxNzIsIm5iZiI6MTcxNTY5NDk3MywiaWF0IjoxNzE1Njk0OTcyLCJqdGkiOiJNVGN4TlRZNU5EazNNZz09In0.gtn2tFn82U8W4etpOG0VtctX1_7-FR4RxmNhctkooUIh2Yu8zOLISuMmeTd9zK_zE33Z18o5nhmaJVJ9qxapFw';
        $token = $request['token'];
        # Hacer una solicitud HTTP al servicio externo
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post($url, [
            'period_' => $request['period_'],
            'planId_' => $request['planId_'],
            'unit_' => $request['unit_']
        ]);

        # Verificar que la solicitud fue exitosa
        if ($response->successful()) {
            # Obtener los datos de la respuesta
            $data = $response->json();

            return Excel::download(new ReportXlsx($data['data'],'reportByGroup'), 'filename.xlsx');
        } else {
            # Manejar el error de la solicitud HTTP
            return response()->json(['error' => 'Hubo un enrror en pedir la informacion'], 500);
        }

    }
}
