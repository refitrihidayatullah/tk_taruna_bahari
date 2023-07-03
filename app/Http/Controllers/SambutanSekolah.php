<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SambutanSekolah extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sambutan_sekolah = DB::table('tb_sambutan')->get();
        return view('backend.management_sekolah.sambutan_sekolah', ['sambutan_sekolah' => $sambutan_sekolah]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul_sambutan' => 'required',
            'isi_sambutan' => 'required'
        ], [
            'judul_sambutan.required' => 'judul sambutan harus diisi',
            'isi_sambutan.required' => 'isi sambutan harus diisi'
        ]);
        if ($validator->fails()) {
            return redirect('profile-sambutan')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_sambutan')->where('id_sambutan', $id)->update([
                'judul_sambutan' => $request->judul_sambutan,
                'isi_sambutan' => $request->isi_sambutan
            ]);
            return redirect('profile-sambutan')->with('success', 'Data Berhasil Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
