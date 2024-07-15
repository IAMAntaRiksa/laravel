<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use thiagoalessio\TesseractOCR\TesseractOCR;

class KtpController extends Controller
{

    public function showForm()
    {
        return view('pages.upload_ktp.upload_ktp');
    }

    public function upload(Request $request)
    {
        try {
            $request->validate([
                'ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imagePath = $request->file('ktp')->store('ktp_images', 'public');

            $ocr = new TesseractOCR(storage_path('app/public/' . $imagePath));
            $ocr->lang('ind');  // Set OCR language to Indonesian
            $text = $ocr->run();

            // Parsing text dari KTP
            $identitas = $this->parseKtpText($text);

            return response()->json(['identitas' => $identitas, 'text' => $text]);
        } catch (\Exception $e) {
            Log::error('Error during OCR processing: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    private function parseKtpText($text)
    {
        $lines = explode("\n", $text);
        $identitas = [];

        // Define patterns for each field
        $patterns = [
            'NIK' => '/NIK\s*[:]*\s*([\d]+)/i',
            'Nama' => '/Nama\s*[:]*\s*(.+)/i',
            'Alamat' => '/Alamat\s*[:]*\s*(.+)/i',
        ];

        // Apply patterns to the text
        foreach ($patterns as $key => $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                $identitas[$key] = trim($matches[1]);
                if ($key == 'Jenis Kelamin') {
                    $identitas['Golongan Darah'] = trim($matches[2]);
                }
            }
        }

        return $identitas;
    }
    
    // public function showForm()
    // {
    //     return view('pages.upload_ktp.upload_ktp');
    // }

    // public function upload(Request $request)
    // {
    //     $request->validate([
    //         'ktp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $imagePath = $request->file('ktp')->store('ktp_images', 'public');

    //     $ocr = new TesseractOCR(storage_path('app/public/' . $imagePath));
    //     $ocr->lang('ind');  // Set OCR language to Indonesian
    //     $text = $ocr->run();

    //     // Parse text from KTP
    //     $identitas = $this->parseKtpText($text);

    //     // Return view with parsed data
    //     return view('pages.upload_ktp.upload_ktp', compact('identitas', 'text'));
    // }

    // private function parseKtpText($text)
    // {
    //     $lines = explode("\n", $text);
    //     $identitas = [];

    //     foreach ($lines as $line) {
    //         if (stripos($line, 'NIK') !== false) {
    //             $identitas['NIK'] = trim(str_replace(['NIK', ':'], '', $line));
    //         }
    //         if (stripos($line, 'Nama') !== false) {
    //             $identitas['Nama'] = trim(str_replace(['Nama', ':'], '', $line));
    //         }
    //         if (stripos($line, 'Tempat/Tgl Lahir') !== false) {
    //             $identitas['Tempat/Tgl Lahir'] = trim(str_replace(['Tempat/Tgl Lahir', ':'], '', $line));
    //         }
    //         if (stripos($line, 'Jenis Kelamin') !== false) {
    //             $identitas['Jenis Kelamin'] = trim(str_replace(['Jenis Kelamin', ':'], '', $line));
    //         }
    //         if (stripos($line, 'Alamat') !== false) {
    //             $identitas['Alamat'] = trim(str_replace(['Alamat', ':'], '', $line));
    //         }
    //     }

    //     // Additional regex parsing if needed
    //     foreach ($lines as $line) {
    //         if (preg_match('/NIK\s*:\s*(\d+)/i', $line, $matches)) {
    //             $identitas['NIK'] = $matches[1];
    //         }
    //         if (preg_match('/Nama\s*:\s*(.*)/i', $line, $matches)) {
    //             $identitas['Nama'] = $matches[1];
    //         }
    //         if (preg_match('/Tempat\/Tgl Lahir\s*:\s*(.*)/i', $line, $matches)) {
    //             $identitas['Tempat/Tgl Lahir'] = $matches[1];
    //         }
    //         if (preg_match('/Jenis Kelamin\s*:\s*(.*)/i', $line, $matches)) {
    //             $identitas['Jenis Kelamin'] = $matches[1];
    //         }
    //         if (preg_match('/Alamat\s*:\s*(.*)/i', $line, $matches)) {
    //             $identitas['Alamat'] = $matches[1];
    //         }
    //     }

    //     return $identitas;
    // }
}
