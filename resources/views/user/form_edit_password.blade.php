@extends('layouts.main')

@section('container')
<form action="/users/update/password/{{ auth()->user()->slug }}" method="POST">
    @method('put')
    @csrf   
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control @error('password') is-invalid  @enderror" id="password" placeholder="Masukkan Password" name="password">
      <input type="hidden" >
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