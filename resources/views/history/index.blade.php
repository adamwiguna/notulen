

@extends('layouts.main')

@section('container')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>   
@endif

<div class="list-user mb-5">
  <table class="table table-sm table-borderless mb-lg-5">
      <tbody>
          @foreach ($histories as $history)
              <tr>
                @if ($history->user)
                <td>  [{{ $history->created_at }}] <text class="text-danger"> {{ $history->user->name }} </text>  {{ $history->status }} <text class="text-info">{{ $history->noteWithTrashed->judul ?? $history->note_id }}</text></td>

                @endif
              </tr>
          @endforeach
      </tbody>
    </table>    
</div>      

@endsection
