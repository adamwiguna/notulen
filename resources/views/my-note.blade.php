
@extends('layouts.main')

@section('container')


    {{-- <p class="text-dark container">
        <a href="/notes/create/form" class="btn btn-primary btn-sm ms-auto"><i class="bi bi-file-earmark-plus"></i> Buat Notes Baru </a>
    </p>  --}}

    
    @if (auth()->user()->is_admin)
        @include('note.nav.adminnav')        
    @else
        @include('note.nav.usernav')
    @endif

    <div class="cobg-white">
    
    <div class="bg-white">
        
        
        {{-- @if (auth()->user()->authorization_level >= 2) --}}
        {{-- @can('search', \App\Models\Note::class)
        
        <div class="row ">
            <div class="col">
                <form action="/notes">
                    <div class="input-group mb-3 shadow-sm">
                        <input type="text" class="form-control" placeholder="Cari" name="cari" value="{{ request('cari') }}">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" type="submite">Cari</button>
                        </div>
                      </div>
                </form>
            </div>
        </div>    
        @endcan --}}
        {{-- @endif --}}

        {{-- @if ($navnote == 'all')
            @include('note.nav.userNavDivisions')        
        @endif --}}

        
        <div class="list-note bg-white">

            
            @livewire('my-list-note')
          
            {{-- @foreach ($notes as $note)              

                <div class="card mb-3 shadow-sm small {{ (!count($note->readHistories->where('user_id', auth()->user()->id))) ? 'border-danger' : '' }}" >

                    @if ($navnote != 'my')
                    <div class="card-header bg-secondary text-white small justify-content-between">
                        <div class=" d-flex justify-content-between">
                            <div>
                        @if ($note->user)
                            Oleh <a href="/users/{{ $note->user->slug }}" class="text-decoration-none text-white">{{ $note->user->name }}</a>  
                     
                        @else
                            Ditulis oleh Anonim 
                        @endif 
                        @if ($navnote == 'all' || $navnote == 'division')
                            @if (!count($note->readHistories))
                                <span class="badge bg-danger text-white ">BARU</span>
                            @endif
                        @endif
                        @if ($navnote == 'new')
                            <span class="badge bg-danger text-white ">BARU</span>
                        @endif
                    </div>
                        <div>
                            <small>{{ $note->created_at->diffForHumans() }}</small>
                          </div>
                      </div>
                    </div>
                    @endif

                    <a href="/notes/{{ $note->slug }}" class="text-decoration-none text-reset">
                    <div class="card-body small">
                    <h6 class="card-title "> 
                        {{ $note['judul'] }}
                        @if (count($note->updateHistories))
                        <span class="badge bg-info text-white text-small">Diedit {{ count($note->updateHistories) }} kali</span>
                        @endif
                    </h6>

                   

                    <p class="card-subtitle  mb-2 "> {{ $note->pemimpin }}, pada {{ App\Http\Controllers\NoteController::tanggal_indo($note->tanggal, true) }}</p>

               
                    @if ($navnote == 'trash' || $navnote == 'alltrash')  
                        @can('restore', $note)
                            <a href="/notes/restore/{{ $note->slug }}" class="btn btn-success btn-sm small" onclick="return confirm('Anda yakin ingin merestore Note ini?')">Restore Note</a>  
                        @endcan 
                        @can('forceDelete', $note)
                            <a href="/notes/forceDelete/{{ $note->slug }}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus permanen Note ini?')">Delete Permanent</a>
                        @endcan
                    @endif

                        @can('update', $note)
                            <a href="/notes/{{ $note['slug'] }}/edit" class="btn btn-sm btn-info"><small> Ubah</small></a>  
                        @endcan

                        @can('delete', $note)
                            <form action="/notes/{{ $note->id }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Note ini?')"><small>Hapus</small></button>
                            </form>
                        @endcan
                </div>
                </a>

                @if ($navnote == 'my')
                    <div class="card-footer text-muted">
                        <small>{{ $note->created_at->diffForHumans() }}</small>
                    </div>
                    @endif
                </div>    
            @endforeach --}}
          
            
            {{-- <div class="d-flex justify-content-center  mb-5">
                {{ $notes->onEachSide(0)->links() }}
            </div> --}}

    
        </div>
    </div>

@endsection
