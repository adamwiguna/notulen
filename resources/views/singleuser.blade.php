
@extends('layouts.main')

@section('container')

<div class="container">
{{-- @dd($imageUpload) --}}
        <div class="list-note">

                <div class="card mb-3" >
                    <div class="card-body">
                        <h5 class="card-title"> {{ $user['name'] }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted"> {{ $user['email'] }}</h6>
                    </div>   
                </div>  
                
                <div class="row row-cols-2">
                    <div class="col">
                        <div class="card text-white bg-info mb-3" style="max-width: 10rem;">
                            <div class="card-header">Note Dibuat</div>
                            <div class="card-body">
                              <h1 class="card-title align-items-center text-center">{{ $notes->count() }}</h1>
                            </div>
                          </div>
                    </div>
                    <div class="col">
                        <div class="card text-white bg-warning mb-3" style="max-width: 10rem;">
                            <div class="card-header">Note Dibaca</div>
                            <div class="card-body">
                              <h1 class="card-title text-center">{{ $readHistories->count() }}</h1>
                            </div>
                          </div>
                    </div>
                    <div class="col">
                        <div class="card text-white bg-success mb-3" style="max-width: 10rem;">
                            <div class="card-header">Note Didownload</div>
                            <div class="card-body">
                              <h1 class="card-title text-center">{{ $downloadHistories->count() }}</h1>
                            </div>
                          </div>
                    </div>
                    <div class="col">
                        <div class="card text-white bg-danger mb-3" style="max-width: 10rem;">
                            <div class="card-header">Foto Diupload</div>
                            <div class="card-body">
                              <h1 class="card-title text-center">{{ $imageUpload->count() }}</h1>
                            </div>
                          </div>
                    </div>
                  </div>
                
                <p class="text-secondary">
                    Note yang sudah dibuat <span class="badge bg-info text-white ">{{ $notes->count() }}</span> 
                </p>
                
                @foreach ($notes as $note)
                    <div class="card mb-3" >

                        <div class="card-header small justify-content-between">
                            <div class=" d-flex justify-content-between">
                            @if ($note->user)
                            <div>
                                Oleh <a href="/users/{{ $note->user->slug }}">{{ $note->user->name }}</a>  
                            </div>
                            @else
                                Ditulis oleh Anonim 
                                
                            @endif 
                                @if (!count($note->readHistories))
                                <div>
                                    <span class="badge bg-danger text-white ">BARU</span>
                                </div>
                                @endif
                               
                          </div>
                        </div>

                        <div class="card-body small">
                            <h6 class="card-title "> 
                                {{ $note['judul'] }}
                                @if (count($note->updateHistories))
                                <span class="badge bg-info text-white text-small">Diedit {{ count($note->updateHistories) }} kali</span>
                                @endif
                            </h6>

                            <p class="card-subtitle  mb-2 "> {{ $note->pemimpin }}, {{ date( 'l d F Y', strtotime($note->tanggal)) }}</p>

                            <a href="/notes/{{ $note->slug }}" class="btn btn-primary btn-sm"><small>Detail</small></a>  {{--<small>{{ $note->created_at->diffForHumans() }}</small> --}}
                
                        
                    </div>

                        <div class="card-footer text-muted small">
                            <small>{{ $note->created_at->diffForHumans() }}</small>
                        </div>

                    </div>     
                @endforeach

                
    
        </div>
</div>
@endsection
