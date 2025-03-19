<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class MemberController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('petugas.member.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('petugas.member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'hp' => 'required|numeric',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('member.index')->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('petugas.member.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'hp' => 'required|numeric',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('member.index')->with('success', 'Pelanggan berhasil diperbarui');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('member.index')->with('success', 'Pelanggan berhasil dihapus');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids'); // Ambil ID yang dikirim dari AJAX
    
        if (!empty($ids)) {
            pelanggan::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Data berhasil dihapus']);
        }
    
        return response()->json(['error' => 'Tidak ada data yang dipilih'], 400);
    }
}
