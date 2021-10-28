@extends('layouts.main')

@section('container')
<form action="/users/simpan" method="POST">
  @csrf
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid  @enderror" id="name" placeholder="Masukkan Nama" name="name" >
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <select class="form-select " aria-label=".form-select-sm example" name="bidang">
        <option selected disabled value="">Bidang</option>
        @foreach ($divisions as $division)
        <option value="{{ old('bidang') ?? $division->id }}">{{ $division->name }}</option>
        @endforeach
      </select>   
      @error('bidang')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <select class="form-select " aria-label=".form-select-sm example" name="level">
        <option selected disabled value="">Authorization Level</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>   
      @error('bidang')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" value="{{ old('email') }}"class="form-control @error('email') is-invalid  @enderror" id="email"  placeholder="Masukkan Email" name="email">
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control @error('password') is-invalid  @enderror" id="password" placeholder="Masukkan Password" name="password">
      @error('password')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="confirmation_password" placeholder="Konfirmasi Password" name="password_confirmation">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>

@endsection