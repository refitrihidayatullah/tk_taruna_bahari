@extends('layout.backend')
@section('title','Users')
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
                <h6 class="m-0 font-weight-bold text-primary">Users Sekolah</h6>
            </a>
            
            @if (Auth::user()->role == 0)
            <a href="" style="width: 9%" class="btn btn-primary btn-icon-split ml-3 mt-3" data-toggle="modal" data-target="#add_user_Modal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
            @else
                
            @endif
          
            
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="addvisi">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Updated_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                use Carbon\Carbon;    
                                @endphp
                                @foreach ($user_sekolah as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role == 0)
                                        <span class="badge badge-primary">SuperAdmin|Kepsek</span>
                                        @else
                                        <span class="badge badge-light">Guru</span>  
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->image_user)
                                        <img  style="width: 80px; height:80px;" src="{{url('guru_images').'/'.$user->image_user}}" alt="">
                                        @else
                                        <img  style="width: 80px; height:80px;" src="{{asset('asset/img/undraw_profile.svg')}}" alt="">
                                        @endif
                                    </td>
                                    <td>{{ Carbon::parse($user->updated_at)->translatedFormat('d F Y H:i')}}</td>
                                    <td>
                                        <a href="" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#edit_user_Modal{{$user->id}}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-pen"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                        @if ($user->role != 0 && Auth::user()->role == 0)
                                        <a href="" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#delete_user_Modal{{ $user->id }}">
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


 <!-- Modal add user -->
 <div class="modal fade" id="add_user_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah user Sekolah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{ url('store-user') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Guru</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{Session::get('name')}}" placeholder="nama guru" name="name" id="name">
                    @error('name')
                    <div class="alert alert-danger" role="alert">
                     {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{Session::get('username')}}" placeholder="username" name="username" id="username">
                    @error('username')
                    <div class="alert alert-danger" role="alert">
                     {{ $message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{Session::get('email')}}" placeholder="email" name="email" id="email">
                    @error('email')
                    <div class="alert alert-danger" role="alert">
                     {{ $message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{Session::get('password')}}" placeholder="password" name="password" id="password">
                    @error('password')
                    <div class="alert alert-danger" role="alert">
                     {{ $message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password1">password confirm</label>
                    <input type="password" class="form-control @error('password1') is-invalid @enderror" value="{{Session::get('password1')}}" placeholder="password confirm" name="password1" id="password1">
                    @error('password1')
                    <div class="alert alert-danger" role="alert">
                     {{ $message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="image_user">upload foto</label>
                  <input type="file" class="form-control @error('image_user') is-invalid @enderror" value="{{Session::get('image_user')}}"  name="image_user" id="image_user">
                  @error('image_user')
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


   <!-- Modal edit user -->
   @foreach ($user_sekolah as $user)
 <div class="modal fade" id="edit_user_Modal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit user Sekolah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{ url("update-user/".$user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="role" value="{{$user->role}}">
                <div class="form-group">
                    <label for="name">Nama Guru</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" placeholder="nama guru" name="name" id="name">
                    @error('name')
                    <div class="alert alert-danger" role="alert">
                     {{ $message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" value="{{$user->username}}" placeholder="username" name="username" id="username">
                    @error('username')
                    <div class="alert alert-danger" role="alert">
                     {{ $message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" placeholder="email" name="email" id="email">
                    @error('email')
                    <div class="alert alert-danger" role="alert">
                     {{ $message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="image_user">upload foto</label>
                  <input type="file" class="form-control @error('image_user') is-invalid @enderror" value="{{$user->image_user}}"  name="image_user" id="image_user">
                  @error('image_user')
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




     <!-- Modal delete user -->
@foreach ($user_sekolah as $user)
<div class="modal fade" id="delete_user_Modal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url("delete-user/". $user->id)}}" method="GET">
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