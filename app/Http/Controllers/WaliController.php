<?php

namespace App\Http\Controllers;

use App\Models\Wali;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wali = Wali::with('siswa')->get();
        return view('wali.index', ['judul' => 'wali'], ['wali' => $wali]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::all();
        return view('wali.create', ['judul' => 'wali'], compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'id_siswa' => 'required|unique:walis',
            'foto' => 'required|image|max:2048'
        ]);

        $wali = new Wali();
        $wali->nama = $request->nama;
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/wali/', $name);
            $wali->foto = $name;
        }
        $wali->id_siswa = $request->id_siswa;
        $wali->save();

        return redirect()->route('wali.index')->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wali  $wali
     * @return \Illuminate\Http\Response
     */
    public function show(Wali $wali)
    {
        return view('wali.show', ['judul' => 'wali'], compact('wali'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wali  $wali
     * @return \Illuminate\Http\Response
     */
    public function edit(Wali $wali)
    {
        $siswa = Siswa::all();
        return view('wali.edit', ['judul' => 'wali'], compact('wali', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wali  $wali
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wali $wali)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'id_siswa' => 'required',
            'foto' => 'image|max:2048'
        ]);

        $wali = $wali;
        $wali->nama = $request->nama;
        if ($request->hasFile('foto')) {
            $wali->deleteImage();
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/wali/', $name);
            $wali->foto = $name;
        }
        $wali->id_siswa = $request->id_siswa;
        $wali->save();

        return redirect()->route('wali.index')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wali  $wali
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wali $wali)
    {
        $wali->deleteImage();
        $wali->delete();

        return redirect()->route('wali.index')->with('success', 'Data berhasil dihapus!');
    }
}
