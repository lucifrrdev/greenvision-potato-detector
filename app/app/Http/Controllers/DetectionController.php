<?php

namespace App\Http\Controllers;

use App\Models\Detection;
use App\Models\DiseaseSolution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DetectionController extends Controller
{
    public function showInput()
    {
        return view('input');
    }

    public function predict(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $file = $request->file('file');
        
        // Simpan gambar secara lokal di public/predictions
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('predictions'), $filename);

        $filePath = public_path('predictions/' . $filename);

        try {
            // Kirim gambar ke Flask API menggunakan Multipart Request
            // Menggunakan DNS internal docker yang dikonfigurasi melalui config/services.php
            $pythonAiUrl = config('services.python_ai.url');
            $response = Http::attach(
                'file', 
                file_get_contents($filePath), 
                $filename
            )->post($pythonAiUrl . '/predict');

            if ($response->failed()) {
                return response()->json([
                    'status' => 'error',
                    'error' => 'Gagal terhubung atau menerima respon dari Flask API.'
                ], 502);
            }

            $data = $response->json();

            if (isset($data['status']) && $data['status'] === 'success') {
                $predictedClass = $data['prediction'] ?? '';
                
                // Cari data solusi di database
                $dbSolution = DiseaseSolution::where('disease_key', $predictedClass)->first();
                
                if ($dbSolution) {
                    $solusi = [
                        'penyakit' => $dbSolution->disease_name,
                        'penyebab' => $dbSolution->cause,
                        'pestisida' => $dbSolution->pesticide,
                        'penyiraman' => $dbSolution->watering,
                        'pencegahan' => $dbSolution->prevention,
                    ];
                } else {
                    $solusi = [
                        'penyakit' => $predictedClass,
                        'penyebab' => '-',
                        'pestisida' => '-',
                        'penyiraman' => '-',
                        'pencegahan' => '-',
                    ];
                }

                // Jika user login, simpan ke database
                if (Auth::check()) {
                    Detection::create([
                        'user_id' => Auth::id(),
                        'image_name' => $filename,
                        'disease_name' => $solusi['penyakit'],
                        'confidence' => $data['confidence'],
                        'details' => $solusi,
                    ]);
                }

                return response()->json([
                    'status' => 'success',
                    'prediction' => $predictedClass,
                    'confidence' => $data['confidence'],
                    'solusi' => $solusi,
                    'image_url' => asset('predictions/' . $filename)
                ]);
            }

            return response()->json([
                'status' => 'error',
                'error' => $data['error'] ?? 'Gagal memproses prediksi daun.'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    public function showHistory()
    {
        $user_id = Auth::id();
        $detections = Detection::where('user_id', $user_id)->latest()->get();
        
        $totalDetections = $detections->count();
        $healthyCount = $detections->filter(function($d) {
            return stripos($d->disease_name, 'sehat') !== false || stripos($d->disease_name, 'healthy') !== false;
        })->count();
        
        $sickCount = $detections->filter(function($d) {
            return stripos($d->disease_name, 'sehat') === false && stripos($d->disease_name, 'healthy') === false;
        })->count();

        $earlyBlightCount = $detections->filter(function($d) {
            return stripos($d->disease_name, 'early') !== false || stripos($d->disease_name, 'bercak') !== false;
        })->count();
        
        $lateBlightCount = $detections->filter(function($d) {
            return stripos($d->disease_name, 'late') !== false || stripos($d->disease_name, 'busuk') !== false;
        })->count();
        
        return view('history', compact('detections', 'totalDetections', 'healthyCount', 'sickCount', 'earlyBlightCount', 'lateBlightCount'));
    }

    public function showDetail($id)
    {
        if (Auth::user()->role === 'admin') {
            $detection = Detection::findOrFail($id);
        } else {
            $detection = Detection::where('user_id', Auth::id())->findOrFail($id);
        }
        return view('detail', compact('detection'));
    }

    public function destroy($id)
    {
        $detection = Detection::where('user_id', Auth::id())->findOrFail($id);
        $filePath = public_path('predictions/' . $detection->image_name);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        $detection->delete();
        return redirect()->route('history')->with('success', 'Riwayat diagnosis berhasil dihapus.');
    }
}
