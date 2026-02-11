<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CertificateOcrController extends Controller
{
    /**
     * Upload file sertifikat untuk diproses OCR
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // max 10MB
            // 'certificate_type' => 'required|in:lambung,mesin,loadline', // HAPUS INI
            'agenda_no' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // DEBUGGING
            \Illuminate\Support\Facades\Log::info('--- Certificate OCR Relay Start ---');
            
            $file = $request->file('file');
            
            // NAIKKAN LIMIT PHP EXECUTION TIME
            set_time_limit(300); // 5 Menit
            
            // URL Flask API (Ambil dari ENV atau hardcode sementara)
            // Anda bisa set di .env: FLASK_OCR_URL=http://localhost:5000/api/certificate-ocr/upload
            $flaskApiUrl = env('FLASK_OCR_URL', 'http://localhost:5000/api/certificate-ocr/upload'); 

            \Illuminate\Support\Facades\Log::info('Forwarding to Flask API: ' . $flaskApiUrl);

            // Kirim file ke Flask API menggunakan HTTP Client Laravel (TIMEOUT DIPERPANJANG)
            $response = \Illuminate\Support\Facades\Http::timeout(300) // Timeout 5 menit
                ->attach(
                    'file', // Nama field di Flask
                    file_get_contents($file->getRealPath()), // Isi file
                    $file->getClientOriginalName() // Nama file asli
                )->post($flaskApiUrl, [
                    'certificate_type' => 'all', // Kirim data tambahan jika perlu
                    'agenda_no' => $request->agenda_no
                ]);

            // Cek response dari Flask
            if ($response->successful()) {
                \Illuminate\Support\Facades\Log::info('Flask API Success');
                return $response->json(); // Teruskan JSON dari Flask langsung ke Frontend
            } else {
                \Illuminate\Support\Facades\Log::error('Flask API Error: ' . $response->body());
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memproses OCR di server eksternal',
                    'error_detail' => $response->body()
                ], $response->status());
            }

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Controller Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Simpan hasil OCR (opsional, jika ingin menyimpan ke database)
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveOcrResult(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agenda_no' => 'required|string',
            'certificate_type' => 'required|in:lambung,mesin,loadline',
            'certificate_number' => 'nullable|string',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
            'raw_ocr_response' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // TODO: Simpan ke database jika diperlukan
            // Untuk sementara hanya return success
            
            return response()->json([
                'success' => true,
                'message' => 'Hasil OCR berhasil disimpan',
                'data' => $request->all()
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan hasil OCR',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
