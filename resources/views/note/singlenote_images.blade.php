
@extends('layouts.main')

@section('container')

@if (session()->has('success'))
{{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>    --}}
@endif

{{-- <div class="container">
  <a href="/note/word-export/{{ $notes->id }}" class="btn btn-primary btn-sm mb-3"><i class="bi bi-download"></i> Download </a>
</div> --}}


<div class="card mb-5">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link " href="/notes/{{ $notes->slug }}">Note</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active " href="/notes/images/{{ $notes->slug }}">Foto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/notes/attendances/{{ $notes->slug }}">Peserta</a>
        </li>
      </ul>
    </div>
    
 

    <div class="card-body">
      @can('addImages', $notes)
      <form action="/notes/images/simpan" method="POST" enctype="multipart/form-data" >
        @csrf
        <div class="input-group input-group-sm mb-3">
          <input type="hidden"  name="note_id" id="" value="{{ $notes->id }}">
          <input type="hidden"  name="note_slug" id="" value="{{ $notes->slug }}">
          
          <div class=" d-flex">
            <input class="form-control form-control-sm" id="formFileSm" type="file" name="image[]" multiple accept="image/*">
            
            <button class="btn btn-info btn-sm" type="submit">Upload</button>
          </div>
      </div>
      </form>
      @endcan

      <div class="row">
        @forelse ($images as $image)
        <a href="{{ $image->image_url }}">
        <div class="col mx-auto col-lg-4">
            <div class="card mb-4 box-shadow mx-auto">
              <div style="">
                <img class="card-img-top " src="{{ $image->image_url }}" >
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <a href="{{ $image->image_url }}"></a>
                      @can('deleteImages', $notes)
                        <form action="/notes/images/{{ $image->id }}" method="POST" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus Note ini?')"> <i class="bi bi-trash"></i> Hapus </button>
                        </form>
                      @endcan
                    </div>
                  {{-- <small class="text-muted">{{ $image->created_at->diffForHumans() }}</small> --}}
                </div>
              </div>
            </div>
          </div>
        </a>
          @empty
          <p>Tidak Ada Foto</p>
          @endforelse
      </div>
 
    </div>

    
  </div>
            
      
@endsection
