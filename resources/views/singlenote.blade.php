
@extends('layouts.main')

@section('container')

{{-- <div class="">
  <a href="/note/word-export/{{ $notes->id }}" class="btn btn-primary btn-sm mb-3"><i class="bi bi-download"></i> Download </a>
</div> --}}

<div class="card mb-5">

    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="/notes/{{ $notes->slug }}">Note</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/notes/attendances/{{ $notes->slug }}">Kehadiran</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/notes/images/{{ $notes->slug }}">Foto</a>
        </li>
      </ul>
    </div>

    <div class="card-body">
        @can('update', $notes)
          <a href="/notes/{{ $notes['slug'] }}/edit" class="btn btn-info btn-sm mb-3"><i class="bi bi-pencil-square"></i> Ubah </a>  {{--<small>{{ $note->created_at->diffForHumans() }}</small> --}}
        @endcan
        @can('delete', $notes)
          <form action="/notes/{{ $notes->id }}" method="POST" class="d-inline">
              @method('delete')
              @csrf
              <button class="btn btn-danger btn-sm mb-3" onclick="return confirm('Anda yakin ingin menghapus Note ini?')"><i class="bi bi-trash"></i> Hapus</button>
          </form>
        @endcan

      <table class="mb-3">
        <tr>
          <td class=" bold">Pemimpin </td>
          <td> : </td>
          <td>{{ $notes->pemimpin }} </td>
        </tr>
        <tr>
          <td>Tanggal </td>
          <td> : </td>
          <td>
            {{ App\Http\Controllers\NoteController::tanggal_indo($notes->tanggal, true) }}
            {{-- {{ date( 'l d F Y', strtotime($notes->tanggal)) }}  --}}
          </td>
        </tr>
        <tr>
          <td class="align-baseline">Penulis </td>
          <td class="align-baseline"> : </td>
          <td>{{ $notes->user->name }} </td>
        </tr>
        <tr>
          <td class="align-baseline">Keterangan </td>
          <td class="align-baseline"> : </td>
          <td>{{ $notes['keterangan'] }} </td>
        </tr>
      </table>
      {{-- <p class="card-subtitle   mb-2"> Pemimpin : {{ $notes->pemimpin }}</p>
      <p class="card-text mb-2"> Tanggal  : {{ date( 'l d F Y', strtotime($notes->tanggal)) }}</p>
      <p class="card-text mb-2"> Yang Hadir  : {{ $notes->hadir }}</p>
      <p class="card-text mb-4">Keterangan : {{ $notes['keterangan'] }}</p> --}}
      <h6 class="card-text mb-2">Pembahasan</h6>
      <div class="">
        <ol class="pl-3">
            @foreach ($isi as $i)
            <li class="card-text">
                {!! $i['isi_note'] !!}
            </li>
            @endforeach
        </ol>
      </div>
    </div>
  </div>
            
      
@endsection
