@extends('layout.backend')

@section('title','Profile Visi Misi')

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
<div class="col-6">
    <!-- Dropdown Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#addvisi" class="d-block card-header py-3" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Visi</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="addvisi">
            <div class="card-body">
                <form action="{{url('profile-visi')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="isi_visi">Visi</label>
                        <textarea name="isi_visi" class="form-control  @error('isi_visi') is-invalid @enderror" id="isi_visi"></textarea>
                        @error('isi_visi')
          <div class="alert alert-danger" role="alert">
            {{ $message}}
          </div>
          @enderror
                      </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
</div>
<div class="col-6">
    <!-- Collapsable Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#addmisi" class="d-block card-header py-3" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Misi</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="addmisi">
            <div class="card-body">
                <form action="{{url('profile-misi')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="isi_misi">Misi</label>
                        <textarea class="form-control  @error('isi_misi') is-invalid @enderror" name="isi_misi" id="isi_misi"></textarea>
                        @error('isi_misi')
          <div class="alert alert-danger" role="alert">
            {{ $message}}
          </div>
          @enderror
                      </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
</div>

</div>


<div class="row">
    <div class="col-6">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#tablevisi" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tables Visi</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="tablevisi">
                <div class="card-body">
                    <table id="" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Visi</th>
                                <th>Updated_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            use Carbon\Carbon;    
                            @endphp
                            @foreach ($profile_visi as $visi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ strip_tags($visi->isi_visi) }}</td>
                                <td>{{ Carbon::parse($visi->updated_at)->translatedFormat('d F Y H:i')}}</td>
                                <td><a href="" class="btn btn-warning btn-sm btn-circle" data-toggle="modal" data-target="#edit_visi_Modal{{$visi->id_visi}}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm btn-circle" data-toggle="modal" data-target="#delete_visi_Modal{{$visi->id_visi}}">
                                    <i class="fas fa-trash"></i>
                                </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">
        <!-- Collapsable Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#tablemisi" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Tables Misi</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="tablemisi">
                <div class="card-body">
                    <table id="misitable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Misi</th>
                                <th>Updated_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profile_misi as $misi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ strip_tags($misi->isi_misi) }}</td>
                                <td>{{ Carbon::parse($misi->updated_at)->translatedFormat('d F y H:s') }}</td>
                                <td><a href="" class="btn btn-warning btn-sm btn-circle" data-toggle="modal" data-target="#edit_misi_Modal{{$misi->id_misi}}">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm btn-circle" data-toggle="modal" data-target="#delete_misi_Modal{{$misi->id_misi}}">
                                    <i class="fas fa-trash"></i>
                                </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    </div>

@endsection


<!-- Modal edit visi -->
@foreach ($profile_visi as $visi) 
<div class="modal fade" id="edit_visi_Modal{{ $visi->id_visi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Visi Sekolah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{url("profile-visi/".$visi->id_visi)}}" method="POST">
                @csrf
                @method('PUT')
            <div class="mb-3">  
                <label for="isi_visi">Visi</label>
                <textarea name="isi_visi" class="form-control @error('isi_visi') is-invalid @enderror" id="isi_visi{{$visi->id_visi}}">{{ $visi->isi_visi }}</textarea>
                @error('isi_visi')
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


  <!-- Modal delete visi -->
@foreach ($profile_visi as $visi)
<div class="modal fade" id="delete_visi_Modal{{ $visi->id_visi }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Visi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url("profile-visi/".$visi->id_visi)}}" method="GET">
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

  <!-- Modal edit misi -->
  @foreach ($profile_misi as $misi) 
  <div class="modal fade" id="edit_misi_Modal{{ $misi->id_misi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Visi Sekolah</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-4">
              <form action="{{url("profile-misi/".$misi->id_misi)}}" method="POST">
                  @csrf
                  @method('PUT')
              <div class="mb-3">  
                  <label for="isi_misi">Misi</label>
                  <textarea name="isi_misi" class="form-control @error('isi_misi') is-invalid @enderror" id="isi_misi{{$misi->id_misi}}">{{ $misi->isi_misi }}</textarea>
                  @error('isi_misi')
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

      <!-- Modal delete misi -->
@foreach ($profile_misi as $misi)
<div class="modal fade" id="delete_misi_Modal{{ $misi->id_misi }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Misi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url("profile-misi/". $misi->id_misi)}}" method="GET">
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
    for(let i = 1; i < 20; i++){
        ClassicEditor
        .create( document.querySelector( '#isi_visi'+i) )
        .catch( error => {
            console.error( error );
        } ); 
        ClassicEditor
        .create( document.querySelector( '#isi_misi'+i) )
        .catch( error => {
            console.error( error );
        } );   
    }
        
</script>



    