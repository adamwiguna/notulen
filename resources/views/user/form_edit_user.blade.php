@extends('layouts.main')

@section('container')
<form action="/users/update/data/{{ auth()->user()->slug }}" method="POST">
  @method('put')
  @csrf
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control @error('name') is-invalid  @enderror" id="name" placeholder="Masukkan Nama" name="name" value="{{ old('name')??auth()->user()->name??'' }}">
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" class="form-control @error('email') is-invalid  @enderror" id="email"  placeholder="Masukkan Email" name="email" value="{{ old('email')??auth()->user()->email??'' }}" >
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>

@endsection