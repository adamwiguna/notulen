@extends('layouts.main')

@section('container')

<form action="/notes/simpan" method="POST" >
  @csrf
    <div class="form-group">
      <label for="judul">Judul Rapat</label>
      <textarea row="2"type="text" class="form-control form-control-sm @error('judul') is-invalid  @enderror" id="judul" placeholder="Masukkan Judul" name="judul" >{{ old('judul') }}</textarea>
        @error('judul')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="keterangan">Pimpinan Rapat</label>
      <input type="text" class="form-control form-control-sm @error('pemimpin') is-invalid  @enderror" id="pemimpin"  placeholder="Masukkan Keterangan" name="pemimpin" value="{{ old('pemimpin') }}">
      @error('pemimpin')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="keterangan">Yang Hadir <a class="text-decoration-none  fst-italic text-danger" href="">-Pisahakan Dengan , (koma)-</a> </label>
      <input type="text" class="form-control form-control-sm @error('hadir') is-invalid  @enderror" id="hadir"  placeholder="Masukkan Keterangan" name="hadir" value="{{ old('hadir', auth()->user()->name) }}">
      @error('hadir')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="keterangan">Keterangan</label>
      <input type="text" class="form-control form-control-sm @error('keterangan') is-invalid  @enderror" id="keterangan"  placeholder="Masukkan Keterangan" name="keterangan">
      @error('keterangan')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
   
    <div class="form-group">
      <label for="tanggal">Tanggal</label>
      <input type="date" class="form-control form-control-sm @error('tanggal') is-invalid  @enderror" id="tanggal" name="tanggal">
      @error('tanggal')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control @error('penulis') is-invalid  @enderror" id="penulis" name="penulis" value="{{ auth()->user()->id }}">
      @error('penulis')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="isi">Materi yang dibahas</label>
      <textarea rows="3" type="text" class="form-control form-control-sm @error('isi') is-invalid  @enderror" id="isi" name="isi1">{{ old('isi1', $note->notedetail[0]->isi_note??'') }}</textarea>
        @error('isi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <textarea rows="3" class="form-control form-control-sm @error('isi') is-invalid  @enderror" id="isi" name="isi2" value="{{ old('isi2', $note->notedetail[1]->isi_note??'') }}">{{ old('isi2', $note->notedetail[1]->isi_note??'') }}</textarea>
        @error('isi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <textarea rows="3" type="text" class="form-control form-control-sm @error('isi') is-invalid  @enderror" id="isi" name="isi3" value="{{ old('isi3')??$note->notedetail[2]->isi_note??'' }}">{{ old('isi3', $note->notedetail[2]->isi_note??'') }}</textarea>
        @error('isi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <textarea rows="3" type="text" class="form-control form-control-sm @error('isi') is-invalid  @enderror" id="isi" name="isi4" value="{{ old('isi4')??$note->notedetail[3]->isi_note??'' }}">{{ old('isi4', $note->notedetail[3]->isi_note??'') }}</textarea>
        @error('isi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <textarea rows="3" type="text" class="form-control form-control-sm @error('isi') is-invalid  @enderror" id="isi" name="isi5" value="{{ old('isi5')??$note->notedetail[4]->isi_note??'' }}">{{ old('isi5', $note->notedetail[4]->isi_note??'') }}</textarea>
        @error('isi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
   
    <div class="form-group  mb-5">
      <button type="submit" class="btn btn-primary mb-5">Simpan</button>
    </div>
</form>

@endsection