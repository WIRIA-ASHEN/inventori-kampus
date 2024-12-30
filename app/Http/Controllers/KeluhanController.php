<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function index()
    {
        $keluhans = Keluhan::all();
        return view('pages.keluhan.keluhan', compact('keluhans'));
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
}
