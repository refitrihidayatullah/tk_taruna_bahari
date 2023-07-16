<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendHomeController extends Controller
{
    public function index()
    {
        $informasi_pendaftaran = DB::table('tb_informasi')->get();
        $slide_gambar = DB::table('tb_galeri')->limit(10)->get();
        $profile_sekolah = DB::table('tb_profile_sekolah')->first();
        return view(
            'frontend.home',
            [
                'informasi_pendaftaran' => $informasi_pendaftaran,
                'slide_gambar' => $slide_gambar,
                'profile_sekolah' => $profile_sekolah,
            ]
        );
    }
    public function indexProfile()
    {
        return view('frontend.profile');
    }
    public function indexGaleri()
    {
        return view('frontend.galeri');
    }
    public function indexDataGuru()
    {
        return view('frontend.dataguru');
    }
}
