

@extends('layouts.main')

@section('container')

{{-- @dd($notes) --}}

        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>   
        @endif
        

        @foreach ($notes as $note)
        <div class=" border mb-2 pb-2">
            <a href="/notes/{{ $note->slug }}" class=" text-decoration-none">
                <div class="text-start mx-3 my-1 text-dark">{{ $note->judul }}</div>
            </a>
        <div class="container">
            <div class="row row-cols-3 justify-content-start">
                @foreach ($note->noteImages as $image)
                <a href="{{ $image->image_url }}" class="m-0 p-0">
                <img class=" img-thumbnail p-1" src="{{ $image->image_url }}" alt="" style="width: 115px; height: 115px">
                </a>
                @endforeach
            </div>
        </div>   
        </div>   
        @endforeach

@endsection
