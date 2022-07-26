<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
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
        $nilai = Nilai::all();
        return view('nilai.index', ["judul" => "Nilai"], compact('nilai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nilai.create', ["judul" => "Nilai"]);
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
            'nis' => 'required|unique:nilais|max:225',
            'kode_mp' => 'required|unique:nilais|max:225',
            'nilai' => 'required',
        ]);

        $nilai = new Nilai();
        if ($request->nilai >= 90) {
            $grade = 'A';
        } elseif ($request->nilai >= 80) {
            $grade = 'B';
        } elseif ($request->nilai >= 70) {
            $grade = 'C';
        } elseif ($request->nilai >= 60) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }
        $nilai->nis = $request->nis;
        $nilai->kode_mp = $request->kode_mp;
        $nilai->nilai = $request->nilai;
        $nilai->index_nilai = $grade;
        $nilai->save();

        return redirect()->route('nilai.index')->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        return view('nilai.show', ["judul" => "Nilai"], compact('nilai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        return view('nilai.edit', ["judul" => "Nilai"], compact('nilai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        $validated = $request->validate([
            'nis' => 'required|max:225',
            'kode_mp' => 'required|max:225',
            'nilai' => 'required'
        ]);


        $nilai->nis = $request->nis;
        $nilai->kode_mp = $request->kode_mp;
        $nilai->nilai = $request->nilai;
        if ($request->nilai >= 90) {
            $grade = 'A';
        } elseif ($request->nilai >= 80) {
            $grade = 'B';
        } elseif ($request->nilai >= 70) {
            $grade = 'C';
        } elseif ($request->nilai >= 60) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }
        $nilai->index_nilai = $grade;
        $nilai->save();

        return redirect()->route('nilai.index')->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('nilai.index')->with('success', 'Data berhasil diedit');
    }
}
