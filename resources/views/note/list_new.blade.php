{{-- @dd($readNoteHistoriesByThisUser) --}}
@extends('layouts.main')

@section('container')

    <p class="text-dark">
        <a href="/notes/create/form" class="btn btn-primary btn-sm ms-auto"><i class="bi bi-file-earmark-plus"></i> Buat Notes Baru </a>
    </p> 

@include('user.nav')


        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>   
        @endif
    
        <div class="row">
            <div class="col">
                <form action="/notes">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari" name="cari" value="{{ request('cari') }}">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="submite">Cari</button>
                        </div>
                      </div>
                </form>
            </div>
        </div>
        
        <div class="list-note bg-white">

            @if ($notes->count())
          
            @foreach ($notes as $note)
            {{-- @dd($note) --}}
                <div class="card mb-3 shadow-lg" >
                    <div class="card-body">
                    <h5 class="card-title"> <text class="text-danger"> BARU </text>{{ $note->id }}{{ $note['judul'] }}</h5>

                    <h6 class="card-subtitle mb-2"> {{ $note['keterangan'] }}</h6>

                    @if ($note->user)
                    <p class="card-text">
                        Ditulis oleh <a href="/users/{{ $note->user->slug }}">{{ $note->user->name }}</a>  pada tanggal {{ $note['tanggal'] }}
                    </p>
                    @else
                        <p class="card-text">
                            Ditulis oleh Anonim pada tanggal {{ $note['tanggal'] }}
                        </p>
                    @endif 
                    
                    <a href="/notes/{{ $note['slug'] }}" class="btn btn-primary">Lihat Detail</a>  {{--<small>{{ $note->created_at->diffForHumans() }}</small> --}}
                    </div>
                </div>  
                
            @endforeach
            @else
            Tidak ada Note
            @endif
            
            <div class="d-flex justify-content-center  mb-5">
                {{ $notes->onEachSide(0)->links() }}
            </div>

    
        </div>

@endsection
