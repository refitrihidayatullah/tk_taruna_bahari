@extends('layout.frontend')
@section('content')
<div class="content content-height profile-height">
  @php
      $profile = DB::table('tb_profile_sekolah')->first();
      $guru_sekolah = DB::table('users')->where('id','!=',1)->get();
  @endphp
    <div class="dataguru">
      <div class="content-guru">
        <div class="judul-guru">
          <h1 style="text-transform: uppercase">Guru {{ $profile->nama_sekolah }}</h1>
        </div>
        <div class="body-guru">
          @foreach ($guru_sekolah as $guru)
              @if ($guru->role == 0)
              <div class="card-guru">
                @if ($guru->image_user)
                <img src="{{url('guru_images').'/'.$guru->image_user}}" alt="" />
                @else
                <img  style="width: 80px; height:80px;" src="{{asset('asset/img/undraw_profile.svg')}}" alt="">
                @endif
                <div class="title-guru">
                  <h3>Kepala Sekolah</h3>
                </div>
                <div class="nama-guru">
                  <h3>{{ $guru->name }}</h3>
                </div>
              </div> 
              @else
              <div class="card-guru">
                @if ($guru->image_user)
                <img src="{{url('guru_images').'/'.$guru->image_user}}" alt="" />
                @else
                <img  style="width: 80px; height:80px;" src="{{asset('asset/img/undraw_profile.svg')}}" alt="">
                @endif
                <div class="title-guru">
                  <h3>Guru</h3>
                </div>
                <div class="nama-guru">
                  <h3>{{ $guru->name }}</h3>
                </div>
              </div>  
              @endif

          
          @endforeach
  
        </div>
      </div>
    </div>


@endsection