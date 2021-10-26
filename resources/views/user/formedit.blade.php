@extends('layouts.main')

@section('container')

<div class="container">
<form action="/user/{{ $user->slug }}/update" method="POST">
  @method('put')
  @csrf
    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" class="form-control @error('name') is-invalid  @enderror" id="name" placeholder="Masukkan Nama" name="name" value="{{ old('name', $user->name) }}">
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <select class="form-select " aria-label=".form-select-sm example" name="bidang">
        <option selected disabled>Bidang</option>
        @foreach ($divisions as $division)
        <option value="{{ $division->id }}" {{ $division->id == $user->division_id ?'selected':'' }}>{{ $division->name }}</option>
        @endforeach
      </select>   
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" class="form-control @error('email') is-invalid  @enderror" id="email"  placeholder="Masukkan Email" name="email" value="{{ old('email', $user->email) }}">
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
</div>

@endsection