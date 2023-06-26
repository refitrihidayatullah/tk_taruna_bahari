@extends('layout.frontend')
@section('content')
<div class="content content-height profile-height">
    <div class="dataguru">
      <div class="content-guru">
        <div class="judul-guru">
          <h1>Guru TK Taruna Bahari</h1>
        </div>
        <div class="body-guru">
          <div class="card-guru">
            <img src="{{asset('asset_ku/img/kepsek.png')}}" alt="" />
            <div class="title-guru">
              <h3>Kepala Sekolah</h3>
            </div>
            <div class="nama-guru">
              <h3>Uni Yana</h3>
            </div>
          </div>
          <div class="card-guru">
            <img src="{{asset('asset_ku/img/kepsek.png')}}" alt="" />
            <div class="title-guru">
              <h3>Guru 1</h3>
            </div>
            <div class="nama-guru">
              <h3>Uni Yana</h3>
            </div>
          </div>
          <div class="card-guru">
            <img src="{{asset('asset_ku/img/kepsek.png')}}" alt="" />
            <div class="title-guru">
              <h3>Guru 2</h3>
            </div>
            <div class="nama-guru">
              <h3>Uni Yana</h3>
            </div>
          </div>
        </div>
      </div>
    </div>


@endsection