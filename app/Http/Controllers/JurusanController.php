<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('jurusan.index', ["judul" => "Jurusan"], compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jurusan.create', ["judul" => "Jurusan"],);
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
            'kode_mp' => 'required|unique:jurusans|max:225',
            'nama_mp' => 'required',
            'semester' => 'required',
            'jurusan' => 'required',
        ]);

        $jurusan = new Jurusan();
        $jurusan->kode_mp = $request->kode_mp;
        $jurusan->nama_mp = $request->nama_mp;
        $jurusan->semester = $request->semester;
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        return view('jurusan.show', ["judul" => "Jurusan"], compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', ["judul" => "Jurusan"], compact('jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'kode_mp' => 'required|max:225',
            'nama_mp' => 'required',
            'semester' => 'required',
            'jurusan' => 'required',
        ]);

        $jurusan->kode_mp = $request->kode_mp;
        $jurusan->nama_mp = $request->nama_mp;
        $jurusan->semester = $request->semester;
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();

        return redirect()->route('jurusan.index')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('jurusan.index')->with('success', 'Data berhasil dihaspus!');
    }
}
