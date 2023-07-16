@extends('layout.frontend')
@section('content')
<div class="content content-height profile-height">
    <div class="wrapper-profile">
      @php
          $kepsek = DB::table('users')->where('name',"uni yana")->first();
          $sambutan = DB::table('tb_sambutan')->first();
          $visi_sekolah = DB::table('tb_visi')->get();
          $misi_sekolah = DB::table('tb_misi')->get();
      
      @endphp
      <div class="profile-sambutan">
        <div class="image-kepsek">
          <img src="{{url('guru_images'.'/'.$kepsek->image_user)}}" alt="" />
          <h2>Kepala Sekolah</h2>
          <h3 style="text-transform: uppercase">{{ $kepsek->name }}</h3>
        </div>
        <div class="sambutan-kepsek">
          <h1>{{ $sambutan->judul_sambutan }}</h1>
          <p>
            {{strip_tags($sambutan->isi_sambutan)}}
          </p>
        </div>
      </div>

      <div class="profile-visi-misi">
        <div class="visi">
          <div class="visi-title">
            <h1>visi</h1>
            @foreach ($visi_sekolah as $visi)
            <p style="text-transform: uppercase">
         {{$visi->isi_visi}}
            </p>
            @endforeach
          </div>
        </div>
        <div class="misi">
          <div class="misi-title">
            <h1>misi</h1>
            @foreach ($misi_sekolah as $misi)

            <li>
              <p style="text-transform: uppercase">
                {{$misi->isi_misi}}
              </p>
            </li>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    @endsection
