<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananUserController extends Controller
{
    // Form Create
    public function index()
    {
        return view('pemesanan.index');
    }

    // Read Data
    public function data()
    {
        $pemesanans = Pemesanan::latest()->get();
        return view('pemesanan.show', compact('pemesanans'));
    }

    // Process Create
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'raket' => 'nullable|integer',
            'sepatu' => 'nullable|integer',
            'bola' => 'nullable|integer',
        ]);

        Pemesanan::create($validated);

        return redirect('/pemesanan-user/data');
    }

    // Form Edit
    public function edit($id)
    {
        $editData = Pemesanan::findOrFail($id);
        return view('pemesanan.index', compact('editData'));
    }

    // Process Update
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'raket' => 'nullable|integer',
            'sepatu' => 'nullable|integer',
            'bola' => 'nullable|integer',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update($validated);

        return redirect('/pemesanan-user/data');
    }

    // Process Delete
    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->delete();

        return redirect('/pemesanan-user/data');
    }
}