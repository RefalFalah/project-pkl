<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('guru.index', ['judul' => 'Guru'], compact('guru'));
    }

    public function create()
    {
        return view('guru.create', ['judul' => 'Guru']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:gurus',
            'foto' => 'required|image|max:2048',
        ]);

        $guru = new Guru();
        $guru->nama = $request->nama;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/guru/', $name);
            $guru->foto = $name;
        }
        $guru->nip = $request->nip;
        $guru->save();

        return redirect()->route('guru.index')->with('success', 'Data berhasil dibuat!');
    }

    public function show(Guru $guru)
    {
        return view('guru.show', ['judul' => 'Guru'], compact('guru'));
    }

    public function edit(Guru $guru)
    {
        return view('guru.edit', ['judul' => 'Guru'], compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'foto' => 'image|max:2048',
        ]);

        $guru->nama = $request->nama;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/guru/', $name);
            $guru->foto = $name;
        }
        $guru->nip = $request->nip;
        $guru->save();
        return redirect()->route('guru.index')
            ->with('success', 'Data berhasil diedit!');

    }

    public function destroy($id)
    {
        $guru = guru::find($id);
        $foto = $guru->foto;

        if (!guru::destroy($id)) {
            return redirect()->back();
        }
        if ($foto) {
            $guru->deleteImage();
        }
        return redirect()->route('guru.index')
            ->with('success', 'Data berhasil dihapus!');

    }
}
