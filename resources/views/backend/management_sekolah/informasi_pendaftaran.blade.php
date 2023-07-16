@extends('layout.backend')
@section('title','Informasi Pendaftaran');

@section('content')
    
@if(Session::has('failed'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Failed!</strong> {{Session::get('failed')}}.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@elseif(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> {{Session::get('success')}}.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@else
@endif

<div class="row">
    <div class="col-12">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#addvisi" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Pendaftaran</h6>
            </a>
            @if ($cek > 0)
                
            @else
            <a href="" style="width: 9%" class="btn btn-primary btn-icon-split ml-3 mt-3" data-toggle="modal" data-target="#add_informasi_Modal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
            @endif
            
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="addvisi">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Informasi</th>
                                    <th>Keterangan</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                use Carbon\Carbon;    
                                @endphp
                                @foreach ($informasi as $info)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $info->judul_informasi }}</td>
                                    <td>{{ strip_tags
                                    ($info->isi_informasi) }}</td>
                                    <td>{{ Carbon::parse($info->updated_at)->translatedFormat('d F Y H:i') }}</td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#edit_informasi_Modal{{$info->id_informasi}}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        @if (Auth::user()->role == 0)
                                        <a href="" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete_informasi_Modal{{$info->id_informasi}}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Delete</span>
                                        </a>
                                        @else
                                            
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    </div>
@endsection


<!-- Modal add program -->
<div class="modal fade" id="add_informasi_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Program Sekolah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{ url('store-informasi') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="judul_informasi">Judul Informasi</label>
                  <input type="text" class="form-control @error('judul_informasi') is-invalid @enderror" value="{{old('judul_informasi')}}" name="judul_informasi" id="judul_informasi">
                  @error('judul_informasi')
          <div class="alert alert-danger" role="alert">
            {{ $message}}
          </div>
          @enderror
                </div>
                <div class="form-group">
                    <label for="isi_informasi">Isi Program</label>
                    <textarea class="form-control @error('isi_informasi') is-invalid @enderror" id="add_informasi" name="isi_informasi" rows="3"></textarea>
                    @error('isi_informasi')
                    <div class="alert alert-danger" role="alert">
                      {{ $message}}
                      @enderror
                    </div>
                 
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal edit informasi -->
  @foreach ($informasi as $info)    
<div class="modal fade" id="edit_informasi_Modal{{$info->id_informasi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Informasi Pendaftaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{ url("update-informasi/".$info->id_informasi) }}" method="POST">
                @csrf
                @method('PUT')
                 <div class="form-group">
                  <label for="judul_informasi">Judul Informasi</label>
                  <input type="text" class="form-control @error('judul_informasi') is-invalid @enderror" value="{{$info->judul_informasi}}" name="judul_informasi" id="judul_informasi">
                  @error('judul_informasi')
                <div class="alert alert-danger" role="alert">
                    {{ $message}}
                </div>
                   @enderror
                </div>
                <div class="form-group">
                    <label for="isi_informasi">Isi Informasi</label>
                    <textarea class="form-control @error('isi_informasi') is-invalid @enderror" id="edit_informasi" name="isi_informasi" rows="3">{{$info->isi_informasi}}</textarea>
                    @error('isi_informasi')
                    <div class="alert alert-danger" role="alert">
                      {{ $message}}
                      @enderror
                    </div>
                 
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach


     <!-- Modal delete informasi -->
@foreach ($informasi as $info)
<div class="modal fade" id="delete_informasi_Modal{{ $info->id_informasi }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Informasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url("delete-informasi/". $info->id_informasi)}}" method="GET">
                @csrf
                <h5>Yakin Akan Menghapus Data?</h5>
                <div class="d-flex flex-row-reverse">
            <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Yakin</button>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach








  <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
  <script>
    ClassicEditor
        .create( document.querySelector( '#add_informasi') )
        .catch( error => {
            console.error( error );
        } ); 
        ClassicEditor
        .create( document.querySelector( '#edit_informasi') )
        .catch( error => {
            console.error( error );
        } ); 
  </script>
