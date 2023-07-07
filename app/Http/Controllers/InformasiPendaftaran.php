<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InformasiPendaftaran extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cek = DB::table('tb_informasi')->count();
        $informasi = DB::table('tb_informasi')->get();
        return view('backend.management_sekolah.informasi_pendaftaran', ['informasi' => $informasi, 'cek' => $cek]);
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
        $validator = Validator::make($request->all(), [
            'judul_informasi' => 'required',
            'isi_informasi' => 'required'
        ], [
            'judul_informasi.required' => 'Judul Informasi harus diisi',
            'isi_informasi.required' => 'Isi Informasi harus diisi'
        ]);
        if ($validator->fails()) {
            return redirect('informasi-pendaftaran')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_informasi')->insert([
                'judul_informasi' => $request->judul_informasi,
                'isi_informasi' => $request->isi_informasi,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return redirect('informasi-pendaftaran')->with('success', 'Data Berhasil Ditambahkan');
        }
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
            'judul_informasi' => 'required',
            'isi_informasi' => 'required'
        ], [
            'judul_informasi.required' => 'Judul Informasi harus diisi',
            'isi_informasi.required' => 'Isi Informasi harus diisi'
        ]);
        if ($validator->fails()) {
            return redirect('informasi-pendaftaran')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_informasi')->where('id_informasi', $id)->update([
                'judul_informasi' => $request->judul_informasi,
                'isi_informasi' => $request->isi_informasi,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return redirect('informasi-pendaftaran')->with('success', 'Data Berhasil Diupdate');
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
        DB::table('tb_informasi')->where('id_informasi', $id)->delete();
        return redirect('informasi-pendaftaran')->with('success', 'Data Berhasil Didelete');
    }
}
