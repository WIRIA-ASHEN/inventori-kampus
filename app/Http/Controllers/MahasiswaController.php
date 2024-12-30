<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use App\Models\PeminjamanBarang;
use App\Models\PenempatanBarang;
use Illuminate\Support\Facades\Auth;
use App\Notifications\KeluhanNotification;
use App\Notifications\PeminjamanBarangNotification;

class MahasiswaController extends Controller
{
    public function index()
    {
        $userName = Auth::user()->name;
        $barangRusak = Barang::whereHas('kondisi', function ($query) {
            $query->where('kondisi_barang', 'rusak');
        })->count();

        $barangBaru = Barang::whereHas('kondisi', function ($query) {
            $query->where('kondisi_barang', 'baru');
        })->count();

        $barangBekas = Barang::whereHas('kondisi', function ($query) {
            $query->where('kondisi_barang', 'bekas');
        })->count();

        // Fetch complaints grouped by date
        $complaints = Keluhan::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();


        return view('mahasiswa.index', compact('barangRusak', 'barangBaru', 'barangBekas', 'complaints', 'userName'));
    }

    public function keluhan()
    {
        $userName = Auth::user()->name;
        $barang = Barang::all();

        return view('mahasiswa.keluhan', compact('barang', 'userName'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'keluhan' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'saran' => 'nullable|string|max:255',
        ]);

        // Handle the file upload
        $path = $request->file('gambar')->store('gambar_keluhan', 'public');

        // Create the Keluhan
        $keluhan = Keluhan::create([
            'id_barang' => $request->id_barang,
            'id_user' => auth()->user()->id, // Get the authenticated user's ID
            'keluhan' => $request->keluhan,
            'saran' => $request->saran,
            'gambar' => $path,
            'status' => 'diproses', // Default status
        ]);

        $notifiableUsers = User::whereIn('role', ['admin', 'teknisi'])->get();
        foreach ($notifiableUsers as $notifiableUser) {
            $notifiableUser->notify(new KeluhanNotification($keluhan));
        }

        // Redirect back with a success message
        return redirect()->route('keluhan-mahasiswa')->with('success', 'Keluhan berhasil diajukan.');
    }

    public function pinjaman_barang()
    {
        $userName = Auth::user()->name;
        $barangs = Barang::where('status_pinjaman', 'bisa')->get();
        return view('mahasiswa.pinjam', compact('barangs', 'userName'));
    }

    public function tambah($id)
    {
        $userName = Auth::user()->name;
        $barangs = Barang::findOrFail($id);

        return view('mahasiswa.tambah', compact('barangs', 'userName'));
    }

    public function store_pinjaman(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'keterangan' => 'required|string|max:255',
        ]);

        $barang = Barang::findOrFail($request->id_barang);

        // if ($barang->jumlah_aset < $request->jumlah) {
        //     return back()->withErrors(['jumlah' => 'Jumlah barang yang dipinjam melebihi stok yang tersedia.']);
        // }

        $peminjaman = PeminjamanBarang::create([
            'id_barang' => $request->id_barang,
            'id_user' => auth()->user()->id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'keterangan' => $request->keterangan,
            'tanggal_kembali' => $request->tanggal_kembali,
            'respon' => $request->respon,
            'status' => 'diproses',
        ]);

        // $barang->decrement('jumlah_aset', $request->jumlah);

        // Send notification to the user
        $user = auth()->user();
        $user->notify(new PeminjamanBarangNotification($peminjaman));

        // Notify all admin and teknisi users
        $notifiableUsers = User::whereIn('role', ['admin', 'teknisi'])->get();
        foreach ($notifiableUsers as $notifiableUser) {
            $notifiableUser->notify(new PeminjamanBarangNotification($peminjaman));
        }

        return redirect()->route('pinjaman-mahasiswa')->with('success', 'Peminjaman barang berhasil, tunggu konfirmasi.');
    }

    public function readAll_mahasiswa()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }

    
}
