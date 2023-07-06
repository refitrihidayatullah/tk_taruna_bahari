<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class ProfileVisiMisi extends Controller
{
    public function index()
    {
        $profile_visi = DB::table('tb_visi')->get();
        $profile_misi = DB::table('tb_misi')->get();
        return view('backend.management_sekolah.profile_visi_misi', [
            'profile_visi' => $profile_visi,
            'profile_misi' => $profile_misi
        ]);
    }
    public function storeVisi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isi_visi' => 'required'
        ], [
            'isi_visi.required' => 'visi harus diisi'
        ]);

        if ($validator->fails()) {
            return redirect('profile-visi-misi')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_visi')->insert([
                'isi_visi' => $request->isi_visi,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            return redirect('profile-visi-misi')->with('success', 'Data Berhasil Ditambahkan');
        }
    }
    public function storeMisi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'isi_misi' => 'required'
        ], [
            'isi_misi.required' => 'misi harus diisi'
        ]);
        if ($validator->fails()) {
            return redirect('profile-visi-misi')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_misi')->insert([
                'isi_misi' => $request->isi_misi,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            return redirect('profile-visi-misi')->with('success', 'Data Berhasil Ditambahkan');
        }
    }
    public function updateVisi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'isi_visi' => 'required'
        ], [
            'isi_visi.required' => 'visi harus diisi'
        ]);

        if ($validator->fails()) {
            return redirect('profile-visi-misi')->withErrors($validator)->with('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_visi')->where('id_visi', $id)->update([
                'isi_visi' => $request->isi_visi,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            return redirect('profile-visi-misi')->with('success', 'Data Berhasil Diupdate');
        }
    }
    public function updateMisi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'isi_misi' => ' required'
        ], [
            'isi_misi.required' => 'Misi harus diisi'
        ]);

        if ($validator->fails()) {
            return redirect('profile-visi-misi')->withErrors('failed', 'Terjadi Kesalahan');
        } else {
            DB::table('tb_misi')->where('id_misi', $id)->update([
                'isi_misi' => $request->isi_misi,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            return redirect('profile-visi-misi')->with('success', 'Data Berhasil Diupdate');
        }
    }
    public function deleteVisi($id)
    {
        DB::table('tb_visi')->where('id_visi', $id)->delete();
        return redirect('profile-visi-misi')->with('success', 'Data Berhasil Didelete');
    }

    public function deleteMisi($id)
    {
        DB::table('tb_misi')->where('id_misi', $id)->delete();
        return redirect('profile-visi-misi')->with('success', 'Data Berhasil Didelete');
    }
}
