<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProgramSekolah extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $program_sekolah = DB::table('tb_program')->get();
        return view('backend.management_sekolah.program_sekolah', [
            'program_sekolah' => $program_sekolah,
        ]);
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
        $validation = Validator::make($request->all(), [
            'judul_program' => 'required',
            'isi_program' => 'required'
        ], [
            'judul_program.required' => 'Judul Program harus diisi',
            'isi_program.required' => 'Isi Program harus diisi'
        ]);

        if ($validation->fails()) {
            return redirect('profile-program')->withErrors($validation)->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_program')->insert([
                'judul_program' => $request->judul_program,
                'isi_program' => $request->isi_program,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return redirect('profile-program')->with('success', 'Data Berhasil Ditambahkan');
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
            'judul_program' => 'required',
            'isi_program' => 'required'
        ], [
            'judul_program.required' => 'Judul Program harus diisi',
            'isi_program.required' => 'Judul Program harus diisi'
        ]);
        if ($validator->fails()) {
            return redirect('profile-program')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_program')->where('id_program', $id)->update([
                'judul_program' => $request->judul_program,
                'isi_program' => $request->isi_program,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            return redirect('profile-program')->with('success', 'Data Berhasil diupdate');
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
        DB::table('tb_program')->where('id_program', $id)->delete();
        return redirect('profile-program')->with('success', 'Data Berhasil Didelete');
    }
}
