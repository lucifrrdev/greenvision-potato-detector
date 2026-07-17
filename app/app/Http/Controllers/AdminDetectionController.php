<?php

namespace App\Http\Controllers;

use App\Models\Detection;
use Illuminate\Http\Request;

class AdminDetectionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $detections = Detection::with('user')
            ->when($search, function($query, $search) {
                return $query->where('disease_name', 'like', "%{$search}%")
                             ->orWhereHas('user', function($userQuery) use ($search) {
                                 $userQuery->where('name', 'like', "%{$search}%")
                                           ->orWhere('email', 'like', "%{$search}%");
                             });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.detections.index', compact('detections', 'search'));
    }

    public function show($id)
    {
        $detection = Detection::with('user')->findOrFail($id);
        return view('admin.detections.show', compact('detection'));
    }

    public function destroy($id)
    {
        $detection = Detection::findOrFail($id);
        
        // Hapus file gambar di lokal
        $filePath = public_path('predictions/' . $detection->image_name);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $detection->delete();

        return redirect()->route('admin.detections.index')->with('success', 'Riwayat diagnosis berhasil dihapus oleh Administrator.');
    }
}
