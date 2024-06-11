<?php

use App\Http\Controllers\EjemploPDFController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ReportXlsxController;
use App\Http\Controllers\PdfEnrollmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/reportByGroup', [ReportXlsxController::class, 'xlsxByGroup']);
// Route::post('/generateActasPDF', [PDFController::class, 'generatePDF']);

// Route::post('/forPrograma', [PdfEnrollmentController::class, 'forPrograma']);

// Route::post('/forCurso', [PdfEnrollmentController::class, 'forCurso']);

// Route::post('/forSemestre', [PdfEnrollmentController::class, 'forSemestre']);

// Route::post('/forAnio', [PdfEnrollmentController::class, 'forAnio']);

//Trabajar en tiempo real el pdf
Route::get('/ejemploPdf', [EjemploPDFController::class, 'ejemploPDF']);

//para descargar desde frontend
Route::post('/ejemploPdf', [EjemploPDFController::class, 'ejemploPDF']);
