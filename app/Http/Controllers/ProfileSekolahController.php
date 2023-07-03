<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileSekolah;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function Ramsey\Uuid\v1;

class ProfileSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile_sekolah = DB::table('tb_profile_sekolah')->get();
        return view('backend.management_sekolah.profile_sekolah', ['profile_sekolah' => $profile_sekolah]);
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
        // $data = DB::table('tb_profile_sekolah')->where('id_profile_sekolah', $id)->first();
        // dd($data);
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
        $data = DB::table('tb_profile_sekolah')->where('id_profile_sekolah', $id)->first();
        // $request->validate(
        //     [
        //         'nama_sekolah' => 'required',
        //         'alamat' => 'required',
        //     ],
        //     [
        //         'nama_sekolah.required' => 'Nama sekolah harus diisi',
        //         'alamat.required' => 'alamat harus diisi'
        //     ]
        // );
        $validator = Validator::make($request->all(), [
            'nama_sekolah' => 'required',
            'alamat' => 'required'
        ], [
            'nama_sekolah.required' => 'Nama sekolah harus diisi',
            'alamat.required' => 'Alamat harus diisi'
        ]);
        if ($validator->fails()) {
            return redirect('profile-sekolah')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            $profile['nama_sekolah'] = $request->nama_sekolah;
            $profile['alamat'] = $request->alamat;
            $profile['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $profile = DB::table('tb_profile_sekolah')->where('id_profile_sekolah', $id)->update($profile);
            return redirect('profile-sekolah')->with('success', 'Data Berhasil diubah');
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
