@extends('layout.backend')
@section('title','sosmed galeri')
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
                <h6 class="m-0 font-weight-bold text-primary">Sosial Media Sekolah</h6>
            </a>
            @if ($count >= 3)
                
            @else
            <a href="" style="width: 9%" class="btn btn-primary btn-icon-split ml-3 mt-3" data-toggle="modal" data-target="#add_sosmed_Modal">
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
                                    <th>Nama Sosmed</th>
                                    <th>Keterangan</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                use Carbon\Carbon;    
                                @endphp
                                @foreach ($sosmed as $sm)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sm->nama_sosmed }}</td>
                                    <td>{{ $sm->link_sosmed }}</td>
                                    <td>{{Carbon::parse($sm->updated_at)->translatedFormat('d F y H i') }}</td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#edit_sosmed_Modal{{ $sm->id_sosmed }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        @if (Auth::user()->role == 0)
                                        <a href="" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete_sosmed_Modal{{$sm->id_sosmed}}">
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
    <div class="row">
      <div class="col-12">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#addvisi" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Galeri Sekolah</h6>
            </a>
    
            <a href="" style="width: 9%" class="btn btn-primary btn-icon-split ml-3 mt-3" data-toggle="modal" data-target="#add_galeri_Modal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
          
            
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="addvisi">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                      
                                @foreach ($galeri as $foto)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                      @if( $foto->image)
                                        <img  style="width: 80px; height:80px;" src="{{url('tk_taruna_images').'/'.$foto->image}}" alt="">
                                      @endif
                                    </td>
                                    <td>{{ Carbon::parse($foto->updated_at)->translatedFormat('d F y H i ') }}</td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#edit_galeri_Modal{{ $foto->id_galeri }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        @if (Auth::user()->role == 0)
                                        <a href="" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete_galeri_Modal{{$foto->id_galeri}}">
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



<!-- Modal add sosmed -->
<div class="modal fade" id="add_sosmed_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Program Sekolah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{ url('store-sosmed') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="nama_sosmed">Nama Sosmed</label>
                  <input type="text" class="form-control @error('nama_sosmed') is-invalid @enderror" value="{{old('nama_sosmed')}}" placeholder="instagram" name="nama_sosmed" id="nama_sosmed">
                  @error('nama_sosmed')
          <div class="alert alert-danger" role="alert">
            {{ $message}}
          </div>
          @enderror
                </div>
                <div class="form-group">
                    <label for="link_sosmed">Link Sosmed</label>
                   <input type="text" class="form-control @error('link_sosmed') is-invalid @enderror" value="{{old('link_sosmed')}}" placeholder="https://instagram.com/nama_pengguna" name="link_sosmed" id="link_sosmed">
                    @error('link_sosmed')
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

  <!-- Modal add galeri -->
<div class="modal fade" id="add_galeri_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah galeri Sekolah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
          <form action="{{ url('store-galeri') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="image">upload foto</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{Session::get('image')}}"  name="image" id="image">
                @error('image')
        <div class="alert alert-danger" role="alert">
          {{ $message}}
        </div>
        @enderror
              </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
      </div>
    </div>
  </div>
</div>

  <!-- Modal edit sosmed -->
  @foreach ($sosmed as $sm)
<div class="modal fade" id="edit_sosmed_Modal{{$sm->id_sosmed}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Program Sekolah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{ url("update-sosmed/".$sm->id_sosmed) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="nama_sosmed">Nama Sosmed</label>
                  <input type="text" class="form-control @error('nama_sosmed') is-invalid @enderror" value="{{$sm->nama_sosmed}}" placeholder="instagram" name="nama_sosmed" id="nama_sosmed">
                  @error('nama_sosmed')
          <div class="alert alert-danger" role="alert">
            {{ $message}}
          </div>
          @enderror
                </div>
                <div class="form-group">
                    <label for="link_sosmed">Link Sosmed</label>
                   <input type="text" class="form-control @error('link_sosmed') is-invalid @enderror" value="{{ $sm->link_sosmed}}" placeholder="https://instagram.com/nama_pengguna" name="link_sosmed" id="link_sosmed">
                    @error('link_sosmed')
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
  @endforeach

    <!-- Modal edit galeri -->
@foreach ($galeri as $foto)
<div class="modal fade" id="edit_galeri_Modal{{ $foto->id_galeri }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah galeri Sekolah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-4">
          <form action="{{ url("update-galeri/".$foto->id_galeri) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="image">upload foto</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{ $foto->image }}"  name="image" id="image">
                @error('image')
        <div class="alert alert-danger" role="alert">
          {{ $message}}
        </div>
        @enderror
              </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
      </div>
    </div>
  </div>
</div>
@endforeach

   <!-- Modal delete sosmed -->
@foreach ($sosmed as $sm)
<div class="modal fade" id="delete_sosmed_Modal{{ $sm->id_sosmed }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Sosial Media</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url("delete-sosmed/". $sm->id_sosmed)}}" method="GET">
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

   <!-- Modal delete galeri -->
@foreach ($galeri as $foto)
<div class="modal fade" id="delete_galeri_Modal{{ $foto->id_galeri }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Sosial Media</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url("delete-galeri/". $foto->id_galeri)}}" method="GET">
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