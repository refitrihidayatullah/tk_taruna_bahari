<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeri = DB::table('tb_galeri')->get();
        $sosmed = DB::table('tb_sosmed')->get();
        $count = DB::table('tb_sosmed')->count();
        return view('backend.management_sekolah.sosmed_galeri', [
            'sosmed' => $sosmed,
            'galeri' => $galeri,
            'count' => $count,
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
    public function storeGaleri(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpg,jpeg,png,gif'
        ], [
            'image.required' => 'image harus diisi',
            'image.mimes' => 'format image harus jpg,jpeg,png,gif'
        ]);

        if ($validator->fails()) {
            return redirect('sosmed-galeri')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            $image_file = $request->file('image');
            $image_extension = $image_file->extension();
            $image_rename = "Taruna_bahari" . "_" . date('d_m_y_h_i') . "_" . Str::random(10) . "." . $image_extension;
            $image_file->move(public_path('tk_taruna_images'), $image_rename);

            DB::table('tb_galeri')->insert([
                'image' => $image_rename,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            return redirect('sosmed-galeri')->with('success', 'Image Berhasil di Upload');
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
    public function updateGaleri(Request $request, $id)
    {
        // cek apakah ada foto baru atau tidak //hasfile cek apakah ada upload dari user tau tidak
        if ($request->hasFile('image')) {
            $validator = Validator::make($request->all(), [
                'nama_sosmed' => 'required',
                'link_sosmed' => 'required'
            ], [
                'nama_sosmed.required' => 'nama sosmed harus diisi',
                'link_sosmed.required' => 'link sosmed harus diisi'
            ]);

            $image_file = $request->file('image');
            $image_extension = $image_file->extension();
            $image_rename = "Taruna_bahari" . "_" . date('d_m_y_h_i') . "_" . Str::random(10) . "." . $image_extension;
            $image_file->move(public_path('tk_taruna_images'), $image_rename);

            // jika ada foto baru maka hapus foto lama
            $data_images = DB::table('tb_galeri')->where('id_galeri', $id)->first();
            File::delete(public_path('tlk_taruna_images') . '/' . $data_images->image);
            // $data['image'] = $image_rename;
            DB::table('tb_galeri')->where('id_galeri', $id)->update([
                'image' => $image_rename,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            return redirect('sosmed-galeri')->with('success', 'Berhasil updated data');
        } else {
            $validator = Validator::make($request->all(), [
                'nama_sosmed' => 'required',
                'link_sosmed' => 'required'
            ], [
                'nama_sosmed.required' => 'nama sosmed harus diisi',
                'link_sosmed.required' => 'link sosmed harus diisi'
            ]);
            return redirect('sosmed-galeri')->withErrors($validator)->with('failed', 'Tidak Ada Perubahan');
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
    public function destroyGaleri($id)
    {
        $hapus_image = DB::table('tb_galeri')->where('id_galeri', $id)->first();
        File::delete(public_path('tk_taruna_images') . '/' . $hapus_image->image);
        DB::table('tb_galeri')->where('id_galeri', $id)->delete();
        return redirect('sosmed-galeri')->with('success', 'Data Berhasil Didelete');
    }
}
