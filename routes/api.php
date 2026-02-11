<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OcrController;
use App\Http\Controllers\CertificateOcrController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| File ini khusus untuk endpoint API (JSON)
| Semua route di sini otomatis punya prefix /api
| Contoh:
|   POST http://127.0.0.1:8000/api/ocr/parsing-result
|
*/

// cek API hidup atau tidak
Route::get('/ping', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is alive'
    ]);
});

// endpoint untuk menerima hasil OCR + parsing
Route::post('/ocr/parsing-result', [OcrController::class, 'store']);
// Certificate OCR Routes
Route::post('/certificate-ocr/upload', [CertificateOcrController::class, 'upload']);
Route::post('/certificate-ocr/save-result', [CertificateOcrController::class, 'saveOcrResult']);

