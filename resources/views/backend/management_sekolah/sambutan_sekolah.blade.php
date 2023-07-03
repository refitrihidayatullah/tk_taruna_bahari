@extends('layout.backend')

@section('title','Sambutan Sekolah')

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
                        <th>Judul Sambutan</th>
                        <th>Isi Sambutan</th>
                        <th>Updated_at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @php
                    use Carbon\Carbon;    
                    @endphp
                    @foreach ($sambutan_sekolah as $sambutan) 
              
                    <tr>
                        <td>{{ $loop->iteration;}}</td>
                        <td>{{ $sambutan->judul_sambutan}}</td>
                        <td>{{ strip_tags($sambutan->isi_sambutan)}}</td>
                        <td>{{ Carbon::parse($sambutan->updated_at)->translatedFormat('d F Y H:i')}}</td>
                        <td>
                            <a href="" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#edit_sambutan_Modal{{$sambutan->id_sambutan}}">
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
@foreach ($sambutan_sekolah as $sambutan) 
<div class="modal fade" id="edit_sambutan_Modal{{ $sambutan->id_sambutan}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Sambutan Sekolah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body p-4">
            <form action="{{ url("update-sambutan/" . $sambutan->id_sambutan) }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="judul_sambutan">Judul Sambutan</label>
                  <input type="text" class="form-control @error('judul_sambutan') is-invalid @enderror" value="{{$sambutan->judul_sambutan}}" name="judul_sambutan" id="judul_sambutan">
                  @error('judul_sambutan')
          <div class="alert alert-danger" role="alert">
            {{ $message}}
          </div>
          @enderror
                </div>
                <div class="form-group">
                    <label for="isi_sambutan">Isi Sambutan</label>
                    <textarea class="form-control @error('isi_sambutan') is-invalid @enderror" id="isi_sambutan" name="isi_sambutan" rows="3">{{$sambutan->isi_sambutan}}</textarea>
                    @error('isi_sambutan')
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
  <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
  <script>
    ClassicEditor
        .create( document.querySelector( '#isi_sambutan' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
