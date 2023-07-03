@extends('layout.backend')

@section('title','Profile Sekolah')

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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Profile Sekolah</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sekolah</th>
                        <th>Alamat</th>
                        <th>Updated_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @php
                    use Carbon\Carbon;    
                    @endphp
                    @foreach ($profile_sekolah as $profile) 
              
                    <tr>
                        <td>{{ $loop->iteration;}}</td>
                        <td>{{ $profile->nama_sekolah}}</td>
                        <td>{{ $profile->alamat}}</td>
                        <td>{{ Carbon::parse($profile->updated_at)->translatedFormat('d F Y H:i')}}</td>
                        <td>
                            <a href="" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#edit_profile_Modal{{$profile->id_profile_sekolah}}">
                                <span class="icon text-white-50">
                                    <i class="fas fa-pen"></i>
                                </span>
                                <span class="text">Edit</span>
                            </a>
                        </td>
                    </tr>
                          @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

<!-- Modal -->
@foreach ($profile_sekolah as $profile) 
<div class="modal fade" id="edit_profile_Modal{{ $profile->id_profile_sekolah }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile Sekolah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{ url("update-profile-sekolah/" . $profile->id_profile_sekolah) }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="nama_sekolah">Nama Sekolah</label>
                  <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" value="{{$profile->nama_sekolah}}" name="nama_sekolah" id="nama_sekolah">
                  @error('nama_sekolah')
          <div class="alert alert-danger" role="alert">
            {{ $message}}
          </div>
          @enderror
                </div>
                <div class="form-group">
                    <label for="alamat">alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{$profile->alamat}}</textarea>
                    @error('alamat')
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