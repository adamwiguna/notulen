
@extends('layouts.main')

@section('container')

@if (session()->has('success'))
{{-- <div class="alert alert-success alert-dismissible fade show m-3 p-2" role="alert">
    {{ session('success') }}
    <button type="button" class="close btn-sm" data-dismiss="alert" aria-label="Close">
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
          <a class="nav-link active" href="/notes/attendances/{{ $notes->slug }}">Kehadiran</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/notes/images/{{ $notes->slug }}">Foto</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
  
      @can('addAttendances', $notes)
        <div>
            <form action="/notes/attendances/simpan" method="POST">
              @csrf
              <div class="input-group input-group-sm mb-3">
                <input type="hidden"  name="note_id" id="" value="{{ $notes->id }}">
                <input type="hidden"  name="note_slug" id="" value="{{ $notes->slug }}">
                  <input type="text" class="form-control form-control-sm" placeholder="Nama" name="nama" id="nama" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ old('nama')}}">
                  <input type="text" class="form-control form-control-sm" placeholder="Instansi/Jabatan" name="instansi" id="instansi" aria-label="Recipient's username" aria-describedby="basic-addon2" value="{{ old('instansi')}}">
                  <div class="input-group-append">
                    <button class="btn btn-sm btn-success" type="submit"><i class="bi bi-plus-square"></i></button>
                  </div>
              </div>
            </form>
        </div>
      @endcan
  


      <div class="list-user">
        <table class="table table-sm table-borderless">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Instansi/Jabatan</th>
                @can('deleteAttendances', $notes)
                <th scope="col">Aksi</th>
                @endcan
              </tr>
            </thead>
            <tbody>
                @forelse ($attendances as $attendance)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $attendance->nama }}</td>
                        <td>{{ $attendance->instansi }}</td>
                        @can('deleteAttendances', $notes)
                        <td>
                            {{-- <button type="button" class="btn btn-primary btn-sm" onclick="edituser({{ $attendance->id }}, '{{ $attendance->nama }}', '{{ $attendance->instansi }}');">Edit</button> --}}
                            <form action="/notes/attendances/{{ $attendance->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Note ini?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                        @endcan
                    </tr>
                @empty
                <th scope="row">-</th>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                @endforelse
            </tbody>
          </table>    
    </div>
      
    </div>
  </div>

  {{-- <script language="javascript">
   
    function edituser(id, nama, instansi) {
      console.log(id);
      console.log(nama);
      console.log(instansi);
      ('.nama').val(nama);
      ('#nama').val('nama');
    }

  </script> --}}
            
      
@endsection
