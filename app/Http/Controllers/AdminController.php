<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Keluhan;
use App\Models\Kondisi;
use App\Models\Ruangan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF as PDF;
use App\Models\PeminjamanBarang;
use App\Models\PenempatanBarang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PeminjamanBarangDitolak;
use App\Notifications\PeminjamanBarangSelesai;
use App\Notifications\PeminjamanBarangDiterima;
use App\Notifications\PeminjamanBarangNotification;

class AdminController extends Controller
{
    public function home()
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

        $pengguna = User::count();
        $users = User::all();

        // Fetch complaints grouped by date
        $complaints = Keluhan::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        return view('pages.home', compact('barangRusak', 'barangBaru', 'barangBekas', 'complaints', 'pengguna', 'users', 'userName'));
    }

    public function dataAlat(Request $request)
    {
        $userName = Auth::user()->name;
        $query = Barang::query();
        $search = $request->input('search');

        if ($search) {
            $query->where('nama_barang', 'like', '%' . $search . '%')
                ->orWhere('merek', 'like', '%' . $search . '%')
                ->orWhere('asal_perolehan', 'like', '%' . $search . '%')
                ->orWhereHas('kategori', function ($q) use ($search) {
                    $q->where('nama_kategori', 'like', '%' . $search . '%');
                });
        }

        $databarang = $query->get();

        // $peminjamanbarangs = PenempatanBarang::with(['barang', 'ruangan', 'barang.kategori', 'barang.kondisi'])->get();

        // // Calculate the original jumlah_aset for each barang
        // $originalAset = [];

        // foreach ($peminjamanbarangs as $penempatan) {
        //     $barangId = $penempatan->id_barang;

        //     if (!isset($originalAset[$barangId])) {
        //         $barang = Barang::find($barangId);
        //         $originalAset[$barangId] = $barang->jumlah_aset;
        //     }

        //     $originalAset[$barangId] += $penempatan->jumlah_barang;
        // }

        // // Include peminjaman_barangs in the calculation
        // $peminjamanBarangs = PeminjamanBarang::all();

        // foreach ($peminjamanBarangs as $peminjaman) {
        //     $barangId = $peminjaman->id_barang;
        //     if (!isset($originalAset[$barangId])) {
        //         $barang = Barang::find($barangId);
        //         $originalAset[$barangId] = $barang->jumlah_aset;
        //     }

        //     $originalAset[$barangId] += $peminjaman->jumlah;
        // }


        // Retrieve all barangs
        $barangs = Barang::all();

        // Initialize an array to hold the updated jumlah_aset values
        $updatedAset = [];

        // Get all penempatan_barangs
        $penempatanBarangs = PenempatanBarang::all();
        foreach ($penempatanBarangs as $penempatan) {
            $barangId = $penempatan->id_barang;
            if (!isset($updatedAset[$barangId])) {
                $barang = Barang::find($barangId);
                $updatedAset[$barangId] = $barang->jumlah_aset;
            }
            // Subtract jumlah_barang from the jumlah_aset
            $updatedAset[$barangId] += $penempatan->jumlah_barang;
        }

        // Get all peminjaman_barangs
        $peminjamanBarangs = PeminjamanBarang::all();
        foreach ($peminjamanBarangs as $peminjaman) {
            $barangId = $peminjaman->id_barang;
            $barang = Barang::find($barangId);

            if ($barang) {
                // Initialize jumlah_aset if not already set
                if (!isset($updatedAset[$barangId])) {
                    // $updatedAset[$barangId] = $barang->jumlah_aset;
                }

                // Check if the status of the peminjaman is 'diterima'
                if ($peminjaman->status == 'diterima') {
                    // Subtract jumlah from the jumlah_aset
                    $updatedAset[$barangId] += $peminjaman->jumlah;
                }
            }
        }


        return view('pages.dataalat', compact('databarang', 'barangs', 'updatedAset', 'userName'));
    }

    public function tambah_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,mahasiswa,dosen',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User created successfully.');
    }

    public function tambah_barang()
    {
        $userName = Auth::user()->name;
        $kategoris = Kategori::all();
        $ruangans = Ruangan::all();
        $kondisis = Kondisi::all();

        return view('pages.tambahbarang', compact('kategoris', 'ruangans', 'kondisis', 'userName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|unique:barangs',
            'id_kategori' => 'required|exists:kategoris,id',
            'id_kondisi' => 'required|exists:kondisis,id',
            'nama_barang' => 'required|string|max:100',
            'merek' => 'required|string|max:100',
            'jumlah_aset' => 'required|integer',
            'nilai_per_aset' => 'required|integer',
            'asal_perolehan' => 'required|string|max:100',
            'tahun_perolehan' => 'required|date',
            'gambar_barang' => 'required|image|max:2048',
            'status_pinjaman' => 'required|string|max:2048',
        ]);

        $path = $request->file('gambar_barang')->store('public/storage');

        Barang::create([
            'kode_barang' => $request->kode_barang,
            'id_kategori' => $request->id_kategori,
            'id_kondisi' => $request->id_kondisi,
            'nama_barang' => $request->nama_barang,
            'merek' => $request->merek,
            'jumlah_aset' => $request->jumlah_aset,
            'nilai_per_aset' => $request->nilai_per_aset,
            'asal_perolehan' => $request->asal_perolehan,
            'tahun_perolehan' => $request->tahun_perolehan,
            'gambar_barang' => $path,
            'status_pinjaman' => $request->status_pinjaman,
        ]);

        return redirect()->route('tambahBarang')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit_barang($id)
    {
        $userName = Auth::user()->name;
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        $ruangans = Ruangan::all();
        $kondisis = Kondisi::all();
        // Sesuaikan view dengan nama yang diinginkan, misalnya 'edit_barang'
        return view('pages.editbarang', compact('barang', 'kategoris', 'ruangans', 'kondisis', 'userName'));
    }

    public function update_barang(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|string|unique:barangs',
            'id_kategori' => 'required|exists:kategoris,id',
            'id_kondisi' => 'required|exists:kondisis,id',
            'nama_barang' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'jumlah_aset' => 'required|integer',
            'nilai_per_aset' => 'required|integer',
            'asal_perolehan' => 'required|string|max:255',
            'tahun_perolehan' => 'required|date',
            'status_pinjaman' => 'required|string|max:255',
        ]);

        $barang = Barang::findOrFail($id);

        // Cek apakah ada file gambar yang diupload
        if ($request->hasFile('gambar_barang')) {
            $path = $request->file('gambar_barang')->store('public/storage/images');
            $barang->gambar_barang = $path;
        }

        // Update data barang
        $barang->kode_barang = $request->kode_barang;
        $barang->id_kategori = $request->id_kategori;
        $barang->id_kondisi = $request->id_kondisi;
        $barang->nama_barang = $request->nama_barang;
        $barang->merek = $request->merek;
        $barang->jumlah_aset = $request->jumlah_aset;
        $barang->nilai_per_aset = $request->nilai_per_aset;
        $barang->asal_perolehan = $request->asal_perolehan;
        $barang->tahun_perolehan = $request->tahun_perolehan;
        $barang->status_pinjaman = $request->status_pinjaman;

        $barang->save();

        return redirect()->route('barang.edit', $barang->id)->with('success', 'Data barang berhasil diperbarui.');
    }

    public function delete_barang($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus gambar barang jika ada
        if ($barang->gambar_barang) {
            Storage::delete($barang->gambar_barang);
        }

        $barang->delete();

        return redirect()->route('dataalat.search')->with('delete', 'Data barang berhasil dihapus.');
    }

    public function tambah_kategori()
    {
        $userName = Auth::user()->name;
        $kategoris = kategori::all();
        return view('pages.tambahkategori', compact('kategoris', 'userName'));
    }

    public function store_kategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('tambah.kategori')->with('success', 'Kategori berhasil ditambahkan');

    }
    public function delete_kategori($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect()->route('tambah.kategori')->with('error', 'Kategori tidak ditemukan');
        }

        $kategori->delete();

        return redirect()->route('tambah.kategori')->with('delete', 'Kategori berhasil dihapus');
    }

    public function tambah_ruangan()
    {
        $userName = Auth::user()->name;
        $ruangans = Ruangan::all();
        return view('pages.tambahruangan', compact('ruangans', 'userName'));
    }

    public function store_ruangan(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
        ]);

        $ruangan = new Ruangan();
        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->save();

        return redirect()->route('tambah.ruangan')->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function delete_ruangan($id)
    {
        $ruangan = Ruangan::find($id);

        if (!$ruangan) {
            return redirect()->route('tambah.ruangan')->with('error', 'ruangan tidak ditemukan');
        }

        $ruangan->delete();

        return redirect()->route('tambah.ruangan')->with('success', 'ruangan berhasil dihapus');
    }

    public function ruangan(Request $request)
    {
        $userName = Auth::user()->name;
        $query = PenempatanBarang::query();

        if ($request->has('search')) {
            $query->where('id_ruangan', $request->input('search'));
        }

        $penempatanBarangs = $query->get();
        $ruangans = Ruangan::all();

        return view('pages.ruangan.ruangan', compact('penempatanBarangs', 'ruangans', 'userName'));
    }

    public function tambah_penempatanBarang()
    {
        $userName = Auth::user()->name;
        $ruangans = Ruangan::all();
        $barangs = Barang::all();
        return view('pages.ruangan.tambahpenempatanBarang', compact('ruangans', 'barangs', 'userName'));
    }

    public function penempatan_barang(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'id_ruangan' => 'required|exists:ruangans,id',
            'jumlah_barang' => 'required|integer|min:1',
        ]);

        // Retrieve the selected Barang
        $barang = Barang::find($request->id_barang);

        // Check if the jumlah_barang is greater than the jumlah_aset
        if ($request->jumlah_barang > $barang->jumlah_aset) {
            return back()->withErrors(['jumlah_barang' => 'Jumlah barang melebihi jumlah aset yang tersedia']);
        }

        // Decrease the jumlah_aset in the barangs table
        $barang->jumlah_aset -= $request->jumlah_barang;
        $barang->save();

        // Insert the new penempatan_barang
        PenempatanBarang::create([
            'id_barang' => $request->id_barang,
            'id_ruangan' => $request->id_ruangan,
            'jumlah_barang' => $request->jumlah_barang,
        ]);

        // Redirect back with a success message
        return redirect()->route('tambah_penempatanBarang')->with('success', 'Penempatan barang berhasil disimpan dan jumlah aset diperbarui');
    }

    public function edit_penempatanBarang($id)
    {
        $userName = Auth::user()->name;
        $penempatanBarang = PenempatanBarang::findOrFail($id);
        $barangs = Barang::all();
        $ruangans = Ruangan::all();

        return view('pages.ruangan.editpenempatanBarang', compact('penempatanBarang', 'barangs', 'ruangans', 'userName'));
    }

    public function update_penempatanBarang(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'id_barang' => 'required|exists:barangs,id',
            'id_ruangan' => 'required|exists:ruangans,id',
            'jumlah_barang' => 'required|integer|min:1',
        ]);

        $penempatanBarang = PenempatanBarang::findOrFail($id);
        $barang = Barang::find($request->id_barang);

        // Adjust the jumlah_aset to revert the previous jumlah_barang
        $previousJumlah = $penempatanBarang->jumlah_barang;
        $barang->jumlah_aset += $previousJumlah;

        // Check if the updated jumlah_barang is greater than the updated jumlah_aset
        if ($request->jumlah_barang > $barang->jumlah_aset) {
            return back()->withErrors(['jumlah_barang' => 'Jumlah barang melebihi jumlah aset yang tersedia']);
        }

        // Update the jumlah_aset in the barangs table
        $barang->jumlah_aset -= $request->jumlah_barang;
        $barang->save();

        // Update the penempatan_barang
        $penempatanBarang->update([
            'id_barang' => $request->id_barang,
            'id_ruangan' => $request->id_ruangan,
            'jumlah_barang' => $request->jumlah_barang,
        ]);

        // Redirect back with a success message
        return redirect()->route('penempatan-barang.edit', $penempatanBarang->id)->with('success', 'Penempatan barang berhasil diubah dan jumlah aset diperbarui');
    }

    public function delete_penempatanBarang($id)
    {
        $penempatanBarang = PenempatanBarang::findOrFail($id);
        $barang = Barang::find($penempatanBarang->id_barang);

        // Revert the jumlah_aset in the barangs table
        $barang->jumlah_aset += $penempatanBarang->jumlah_barang;
        $barang->save();

        // Delete the penempatan_barang
        $penempatanBarang->delete();

        // Redirect back with a success message
        return redirect()->route('ruangan')->with('delete', 'Penempatan barang berhasil dihapus dan jumlah aset diperbarui');
    }


    public function pinjaman()
    {
        $userName = Auth::user()->name;
        $peminjamanBarangs = PeminjamanBarang::all();

        $reportPinjaman = PeminjamanBarang::withTrashed()->get();
        return view('pages.pinjaman.pinjaman', compact('peminjamanBarangs', 'reportPinjaman', 'userName'));
    }

    public function tambah_pinjaman($id_penempatan)
    {
        $userName = Auth::user()->name;
        $users = User::all();
        $penempatanBarang = PenempatanBarang::findOrFail($id_penempatan);
        return view('pages.pinjaman.tambahpinjaman', compact('penempatanBarang', 'users', 'userName'));
    }

    public function store_pinjaman(Request $request)
    {
        $request->validate([
            'id_penempatan' => 'required|exists:penempatan_barangs,id',
            'id_user' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
        ]);

        $penempatanBarang = PenempatanBarang::findOrFail($request->id_penempatan);

        if ($penempatanBarang->jumlah_barang < $request->jumlah) {
            return back()->withErrors(['jumlah' => 'Jumlah barang yang dipinjam melebihi stok yang tersedia.']);
        }

        $peminjaman = PeminjamanBarang::create($request->all());

        $penempatanBarang->jumlah_barang -= $request->jumlah;
        $penempatanBarang->save();

        return redirect()->route('penempatan-barang.index')->with('success', 'Peminjaman barang berhasil ditambahkan.');
    }

    public function edit_pinjaman($id)
    {
        $userName = Auth::user()->name;
        $pinjaman = PeminjamanBarang::findOrFail($id);
        return view('pages.pinjaman.editpinjaman', compact('pinjaman', 'userName'));
    }

    public function update_pinjaman(Request $request, $id)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date',
            'respon' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $peminjamanBarang = PeminjamanBarang::findOrFail($id);

        // Check the previous status
        $previousStatus = $peminjamanBarang->status;

        // Update the peminjamanBarang with new data
        $peminjamanBarang->update($request->only(['tanggal_kembali', 'respon', 'status']));

        // Handle status changes and send notifications
        if ($request->status === 'diterima' && $previousStatus !== 'diterima') {
            $barang = Barang::findOrFail($peminjamanBarang->id_barang);
            $barang->decrement('jumlah_aset', $peminjamanBarang->jumlah);

            $user = $peminjamanBarang->user;
            $user->notify(new PeminjamanBarangDiterima($peminjamanBarang));
        } elseif ($request->status === 'ditolak' && $previousStatus !== 'ditolak') {
            $user = $peminjamanBarang->user;
            $user->notify(new PeminjamanBarangDitolak($peminjamanBarang));
        } elseif ($request->status === 'selesai' && $previousStatus !== 'selesai') {
            $barang = Barang::findOrFail($peminjamanBarang->id_barang);

            $user = $peminjamanBarang->user;
            $user->notify(new PeminjamanBarangSelesai($peminjamanBarang));
        }

        return redirect()->route('peminjaman-barang.edit', $peminjamanBarang->id)->with('success', 'Peminjaman barang berhasil diperbarui.');
    }

    public function delete_pinjaman($id)
    {
        $peminjamanBarang = PeminjamanBarang::find($id);

        if ($peminjamanBarang) {
            // Update jumlah_aset in barangs table
            $barang = Barang::find($peminjamanBarang->id_barang);
            if ($barang) {
                $barang->jumlah_aset += $peminjamanBarang->jumlah;
                $barang->save();
            }

            // Soft delete the peminjaman_barang record
            $peminjamanBarang->delete();

            return redirect()->route('pinjaman')->with('success', 'Peminjaman telah selesai barang dikembalikan ke gudang.');
        } else {
            return response()->json(['message' => 'Data peminjaman tidak ditemukan.'], 404);
        }
    }

    public function keluhanadmin()
    {
        $userName = Auth::user()->name;
        $keluhans = Keluhan::all();
        return view('pages.keluhan.keluhan', compact('keluhans', 'userName'));
    }

    public function done($id)
    {
        //  Cari keluhan berdasarkan ID
        $keluhan = Keluhan::find($id);

        // Jika keluhan tidak ditemukan, kembalikan respons error
        if (!$keluhan) {
            return redirect()->back()->with('error', 'Keluhan tidak ditemukan.');
        }

        // Ubah status keluhan menjadi "selesai"
        $keluhan->status = 'selesai';
        $keluhan->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Keluhan berhasil diubah menjadi selesai.');
    }

    public function hapus_keluhan($id)
    {
        // Find the Keluhan by ID
        $keluhan = Keluhan::findOrFail($id);

        // Optionally, delete the associated image file
        if (Storage::exists($keluhan->gambar)) {
            Storage::delete($keluhan->gambar);
        }

        // Delete the Keluhan
        $keluhan->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Keluhan berhasil dihapus.');
    }

    public function laporan()
    {
        $peminjamanbarangs = PenempatanBarang::with(['barang', 'ruangan', 'barang.kategori', 'barang.kondisi'])->get();

        // Calculate the original jumlah_aset for each barang
        $originalAset = [];

        foreach ($peminjamanbarangs as $penempatan) {
            $barangId = $penempatan->id_barang;

            if (!isset($originalAset[$barangId])) {
                $barang = Barang::find($barangId);
                $originalAset[$barangId] = $barang->jumlah_aset;
            }

            $originalAset[$barangId] += $penempatan->jumlah_barang;
        }

        // Include peminjaman_barangs in the calculation
        $peminjamanBarangs = PeminjamanBarang::all();

        foreach ($peminjamanBarangs as $peminjaman) {
            $barangId = $peminjaman->id_barang;
            if (!isset($originalAset[$barangId])) {
                $barang = Barang::find($barangId);
                $originalAset[$barangId] = $barang->jumlah_aset;
            }

            $originalAset[$barangId] += $peminjaman->jumlah;
        }

        $pinjamans = PeminjamanBarang::withTrashed()->get();

        return view('laporan.laporan', compact('peminjamanbarangs', 'originalAset', 'pinjamans'));
    }

    public function generatePDF()
    {
        $barangs = Barang::all();

        // Initialize an array to hold the updated jumlah_aset values
        $updatedAset = [];

        // Get all penempatan_barangs
        $penempatanBarangs = PenempatanBarang::all();
        foreach ($penempatanBarangs as $penempatan) {
            $barangId = $penempatan->id_barang;
            if (!isset($updatedAset[$barangId])) {
                $barang = Barang::find($barangId);
                $updatedAset[$barangId] = $barang->jumlah_aset;
            }
            // Subtract jumlah_barang from the jumlah_aset
            $updatedAset[$barangId] += $penempatan->jumlah_barang;
        }

        // Get all peminjaman_barangs
        $peminjamanBarangs = PeminjamanBarang::all();
        foreach ($peminjamanBarangs as $peminjaman) {
            $barangId = $peminjaman->id_barang;
            if (!isset($updatedAset[$barangId])) {
                $barang = Barang::find($barangId);
                $updatedAset[$barangId] = $barang->jumlah_aset;
            }
            // Subtract jumlah from the jumlah_aset
            $updatedAset[$barangId] += $peminjaman->jumlah;
        }


        $pdf = \PDF::loadView('laporan.laporan-pdf', compact('barangs', 'updatedAset'));

        return $pdf->stream('laporan-barang.pdf');
    }

    public function report_pinjaman()
    {
        $pinjamans = PeminjamanBarang::withTrashed()->get();

        $pdf = \PDF::loadView('laporan.laporan-pinjaman-pdf', compact('pinjamans'));

        return $pdf->stream('laporan-pinjamman.pdf');
    }

    public function exportpdf_ruangan(Request $request)
    {
        $search = $request->input('search');

        // Use the correct relationship method name
        $ruangans = Ruangan::with(['penempatanBarang.barang'])
            ->where('id', $search)
            ->get();

        $pdf = \PDF::loadView('pages.ruangan.ruangan-pdf', compact('ruangans'));

        return $pdf->stream('ruangan-pdf.pdf');
    }

    public function readAll()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }
}
