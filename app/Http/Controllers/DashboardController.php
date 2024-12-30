<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keluhan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $barangRusak = Barang::whereHas('kondisi', function ($query) {
            $query->where('kondisi_barang', 'rusak');
        })->count();

        $barangBaru = Barang::whereHas('kondisi', function ($query) {
            $query->where('kondisi_barang', 'baru');
        })->count();

        $barangBekas = Barang::whereHas('kondisi', function ($query) {
            $query->where('kondisi_barang', 'bekas');
        })->count();
        $barang = Barang::all();
        $complaints = Keluhan::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();
        return view('dashboard.index', compact('complaints', 'barang', 'barangRusak', 'barangBaru', 'barangBekas'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'keluhan' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the file upload
        $path = $request->file('gambar')->store('public/storage');

        // Create the Keluhan
        Keluhan::create([
            'id_barang' => $request->id_barang,
            'keluhan' => $request->keluhan,
            'saran' => $request->saran,
            'gambar' => $path,
            'status' => 'diproses', // default status
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Keluhan berhasil diajukan.');
    }

}
