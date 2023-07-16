@extends('layout.frontend')

@section('content')
<div class="content content-height profile-height">
  @php
      $galeri_sekolah = DB::table('tb_galeri')->get();
  @endphp
    <div class="grid-wrapper">
      @foreach ($galeri_sekolah as $galeri)
      <div>
        <img src="{{url('tk_taruna_images'.'/'.$galeri->image)}}" alt="" />
      </div>
      @endforeach

    </div>

@endsection