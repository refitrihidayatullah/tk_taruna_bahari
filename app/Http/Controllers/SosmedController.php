<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sosmed = DB::table('tb_sosmed')->get();
        return view('backend.management_sekolah.sosmed_galeri', ['sosmed' => $sosmed]);
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
            'nama_sosmed' => 'required',
            'link_sosmed' => 'required'
        ], [
            'nama_sosmed.required' => 'nama sosmed harus diisi',
            'link_sosmed.required' => 'link sosmed harus diisi'
        ]);
        if ($validator->fails()) {
            return redirect('sosmed-galeri')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_sosmed')->insert([
                'nama_sosmed' => $request->nama_sosmed,
                'link_sosmed' => $request->link_sosmed,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return redirect('sosmed-galeri')->with('success', 'Data Berhasil Ditambah');
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
            'nama_sosmed' => 'required',
            'link_sosmed' => 'required'
        ], [
            'nama_sosmed.required' => 'nama sosmed harus diisi',
            'link_sosmed.required' => 'link sosmed harus diisi'
        ]);
        if ($validator->fails()) {
            return redirect('sosmed-galeri')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_sosmed')->where('id_sosmed', $id)->update([
                'nama_sosmed' => $request->nama_sosmed,
                'link_sosmed' => $request->link_sosmed,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            return redirect('sosmed-galeri')->with('success', 'Data Berhasil Diupdate');
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
        DB::table('tb_sosmed')->where('id_sosmed', $id)->delete();
        return redirect('sosmed-galeri')->with('success', 'Data Berhasil Didelete');
    }
}
