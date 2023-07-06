@extends('layout.backend')

@section('title','Program Sekolah')
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
                <h6 class="m-0 font-weight-bold text-primary">Program Sekolah</h6>
            </a>
            <a href="" style="width: 7%" class="btn btn-primary btn-icon-split ml-3 mt-3" data-toggle="modal" data-target="#add_program_Modal">
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
                                    <th>Nama Program</th>
                                    <th>Keterangan</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                use Carbon\Carbon;    
                                @endphp
                              @foreach ($program_sekolah as $program)     
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $program->judul_program }}</td>
                                    <td>{{ $program->isi_program }}</td>
                                    <td>{{ Carbon::parse($program->updated_at)->translatedFormat('d F y H:i') }}</td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#edit_program_Modal{{$program->id_program}}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        <a href="" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete_program_Modal{{$program->id_program}}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Delete</span>
                                        </a>
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
<div class="modal fade" id="add_program_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Program Sekolah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{ url('store-program') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="judul_program">Judul Program</label>
                  <input type="text" class="form-control @error('judul_program') is-invalid @enderror" value="{{old('judul_program')}}" name="judul_program" id="judul_program">
                  @error('judul_program')
          <div class="alert alert-danger" role="alert">
            {{ $message}}
          </div>
          @enderror
                </div>
                <div class="form-group">
                    <label for="isi_program">Isi Program</label>
                    <textarea class="form-control @error('isi_program') is-invalid @enderror" id="isi_program" name="isi_program" rows="3" value="{{old('isi_program')}}"></textarea>
                    @error('isi_program')
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

  <!-- Modal edit program -->
  @foreach ($program_sekolah as $program)    
<div class="modal fade" id="edit_program_Modal{{$program->id_program}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Program Sekolah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{ url("update-program/".$program->id_program) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="judul_program">Judul Program</label>
                  <input type="text" class="form-control @error('judul_program') is-invalid @enderror" value="{{$program->judul_program}}" name="judul_program" id="judul_program">
                  @error('judul_program')
          <div class="alert alert-danger" role="alert">
            {{ $message}}
          </div>
          @enderror
                </div>
                <div class="form-group">
                    <label for="isi_program">Isi Program</label>
                    <textarea class="form-control @error('isi_program') is-invalid @enderror" id="isi_program" name="isi_program" rows="3">{{$program->isi_program}}</textarea>
                    @error('isi_program')
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

        <!-- Modal delete program -->
@foreach ($program_sekolah as $program)
<div class="modal fade" id="delete_program_Modal{{ $program->id_program }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus Program</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url("delete-program/". $program->id_program)}}" method="GET">
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

