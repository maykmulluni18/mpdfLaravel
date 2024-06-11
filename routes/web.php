<?php

use App\Http\Controllers\ReportXlsxController;
use App\Http\Controllers\PDFController;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


Route::get('/', function () {
    return view('welcome');
});

// definir la variable courses como global

$courses = [
    [
        'id' => 1,
        'course' => 'Math to the power of 10 and beyond the universe of the infinite and beyond  forever and ever',
        'cycle' => 'I',
        'credits' => 4,
        'hours' => 64,
        'teacher' => 'John Doe Jane Doe Jane Doe'
    ],
    [
        'id' => 2,
        'course' => 'Science',
        'cycle' => 'II',
        'credits' => 3,
        'hours' => 48,
        'teacher' => 'Jane Doe'
    ],
    [
        'id' => 3,
        'course' => 'History',
        'cycle' => 'III',
        'credits' => 2,
        'hours' => 32,
        'teacher' => 'John Smith'
    ],
    [
        'id' => 4,
        'course' => 'Geography',
        'cycle' => 'IV',
        'credits' => 3,
        'hours' => 48,
        'teacher' => 'Jane Smith'
    ],
    [
        'id' => 5,
        'course' => 'English',
        'cycle' => 'V',
        'credits' => 4,
        'hours' => 64,
        'teacher' => 'John Doe'
    ],
    [
        'id' => 6,
        'course' => 'Spanish',
        'cycle' => 'VI',
        'credits' => 3,
        'hours' => 48,
        'teacher' => 'Jane Doe'
    ],
    [
        'id' => 7,
        'course' => 'Art',
        'cycle' => 'VII',
        'credits' => 2,
        'hours' => 32,
        'teacher' => 'John Smith'
    ],
    [
        'id' => 8,
        'course' => 'Music',
        'cycle' => 'VIII',
        'credits' => 3,
        'hours' => 48,
        'teacher' => 'Jane Smith'
    ],
    [
        'id' => 9,
        'course' => 'Physical Education',
        'cycle' => 'IX',
        'credits' => 4,
        'hours' => 64,
        'teacher' => 'John Doe'
    ],

];
Route::get('/snappy-pdf', function ()  use ($courses){


    $_courses = $courses;

    // obtener  la vsita desde la ruta views.pdf.test.snappy

    // incluir cabezera

    $pdf = SnappyPdf::loadView('pdf.test.snappy', compact('courses'));

    $pdf->setOption('enable-javascript', true);
    $pdf->setOption('no-stop-slow-scripts', true);

    $pdf->setOptions([
        'margin-right' => '0.5cm',
        'margin-top' => '4cm',
        'margin-bottom' => '0.5cm',
        'margin-left' => '0.5cm',
        'encoding' => 'UTF-8',
        'orientation' => 'landscape',
        'page-size' => 'a4',
        //paginacion
        'footer-right' => '[page] / [toPage]',
        'header-html' => view('pdf.test._header'),
    ]);

    // Obtén el contenido del PDF como una cadena de texto
    $pdfContent = $pdf->output();

    // Devuelve el PDF al navegador con los encabezados adecuados
    return response($pdfContent, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="test.pdf"');
});

Route::get('/report-actas', function () {


    // Cargar la vista PDF y pasar el código QR como una variable
    $pdf = SnappyPdf::loadView('pdfActas.pdfActas', compact('qrCode'));
    //$pdf = SnappyPdf::loadView('pdfActas.pdfActas');
    $pdf->setOption('enable-javascript', true);
    $pdf->setOption('no-stop-slow-scripts', true);
    $pdf->setOptions([
        'margin-right' => '0.cm',
        'margin-top' => '1.8cm',
        'margin-bottom' => '0.5cm',
        'margin-left' => '0.5cm',
        'encoding' => 'UTF-8',
        'orientation' => 'portrait',
        'page-size' => 'a4',
        //paginacion
        'footer-right' => '[page] / [toPage]',
        'header-html' => view('pdfActas._header'),
    ]);
    $pdfContent = $pdf->output();
    return response($pdfContent, 200)
    ->header('Content-Type', 'application/pdf')
    ->header('Content-Disposition', 'inline; filename="test.pdf"');

});

Route::get('/dompdf', function () use ($courses) {
    $courses = $courses;
    $pdf = PDF::loadView('pdf.test.snappy', compact('courses'));
    // horizontal
    $pdf->setPaper('a4', 'landscape');




    return $pdf->stream('test.pdf');
});

// Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);

#Route::get('/reportByGroup', [ReportXlsxController::class,'xlsxByGroup']);


// Route::get('/qr-code', function () {
//     $qrCode = QrCode::size(300)
//         ->backgroundColor(255, 255, 204)
//         ->generate('Hello, World!');
//     return view('qr-code', compact('qrCode'));
// });
