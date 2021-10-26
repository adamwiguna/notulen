

@extends('layouts.main')

@section('container')

    
        {{-- <p class="text-dark ms-auto">
            <a href="/users/create/form" class="btn btn-primary btn-sm ms-auto"><i class="bi bi-person-plus"></i> Buat User Baru </a>
        </p>  --}}

        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>   
        @endif
        
        <div class="list-user">
            <table class="table table-sm table-borderless">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    @can('update', \App\Models\User::class)
                    <th scope="col">Aksi</th>
                    @endcan
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><a href="/users/{{ $user['slug'] }}" class="text-decoration-none text-dark">{{ $user->name }}</a></td>
                            <td>
                              @can('update', \App\Models\User::class)
                                <a href="/user/{{ $user['slug'] }}/edit" class="btn btn-sm btn-info text-white"><i class="bi bi-pencil-square"></i></a> 
                              @endcan
                              @can('delete', \App\Models\User::class)
                                <form action="/user/{{ $user->slug }}" method="POST" class="d-inline">
                                  @method('delete')
                                  @csrf
                                  <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus User ini?')"><i class="bi bi-trash"></i></button>
                                </form>
                              @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>    
        </div>

@endsection
