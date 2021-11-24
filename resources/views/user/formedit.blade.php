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
      <label for="nama">Jabatan</label>
      <input type="text" value="{{ old('jabatan', $user->jabatan) }}" class="form-control @error('jabatan') is-invalid  @enderror" id="jabatan" placeholder="Masukkan Jabatan" name="jabatan" >
      @error('name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="nama">Bidang</label>
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
      <label for="nama">Level</label>
      <select class="form-select " aria-label=".form-select-sm example" name="level">
        <option selected disabled value="">Authorization Level</option>
        {{-- <option value="0" {{ ($user->authorization_level == 0) ? 'selected' :'' }}>0</option>
        <option value="1" {{ ($user->authorization_level == 1) ? 'selected' :'' }}>1</option>
        <option value="2" {{ ($user->authorization_level == 2) ? 'selected' :'' }}>2</option>
        <option value="3" {{ ($user->authorization_level == 3) ? 'selected' :'' }}>3</option>
        <option value="4" {{ ($user->authorization_level == 4) ? 'selected' :'' }}>4</option>
        <option value="5" {{ ($user->authorization_level == 5) ? 'selected' :'' }}>5</option>   <option selected disabled value="">Authorization Level</option> --}}
        <option value="0" {{ ($user->authorization_level == 0) ? 'selected' :'' }}>Dapat Lihat Note Sendiri</option>
        {{-- <option value="1">Dapat Lihat Note Sendiri</option> --}}
        <option value="2" {{ ($user->authorization_level == 2) ? 'selected' :'' }}>Dapat Lihat Note Sendiri + Note Pegawai Lain</option>
        {{-- <option value="3">Dapat Lihat Note Sendiri + Note Pegawai Lain + Histories</option>
        <option value="4">Dapat Lihat Note Sendiri + Note Pegawai Lain + Histories + List User</option>
        <option value="5">Dapat Lihat Note Sendiri + Note Pegawai Lain + Histories + List User</option> --}}
     

      </select>   
      @error('bidang')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="email">Email/NIP (username untuk melakukan login)</label>
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