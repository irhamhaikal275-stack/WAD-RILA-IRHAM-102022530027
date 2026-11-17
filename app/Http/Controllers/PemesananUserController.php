<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PemesananUserController extends Controller
{
    // Form Create
    public function index()
    {
        Gate::authorize('create', Pemesanan::class);

        return view('pemesanan.index');
    }

    // Read Data
    public function data()
    {
        Gate::authorize('viewAny', Pemesanan::class);

        $pemesanans = Pemesanan::latest()->get();
        return view('pemesanan.show', compact('pemesanans'));
    }

    // Process Create
    public function store(Request $request)
    {
        Gate::authorize('create', Pemesanan::class);

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
        Gate::authorize('update', $editData);
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
        Gate::authorize('update', $pemesanan);
        $pemesanan->update($validated);

        return redirect('/pemesanan-user/data');
    }

    // Process Delete
    public function destroy($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        Gate::authorize('delete', $pemesanan);
        $pemesanan->delete();

        return redirect('/pemesanan-user/data');
    }
}