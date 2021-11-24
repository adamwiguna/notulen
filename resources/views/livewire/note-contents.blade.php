<div>
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
            <label for="keterangan">Pimpinan/Penyelenggara Rapat</label>
            <input type="text" class="form-control form-control-sm @error('pemimpin') is-invalid  @enderror" id="pemimpin"  placeholder="Masukkan Keterangan" name="pemimpin" value="{{ old('pemimpin') }}">
            @error('pemimpin')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
          {{-- <div class="form-group">
            <label for="keterangan">Yang Hadir </label>
            <input type="text" class="form-control form-control-sm @error('hadir') is-invalid  @enderror" id="hadir"  placeholder="Masukkan Keterangan" name="hadir" value="{{ old('hadir', auth()->user()->name) }}">
            @error('hadir')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div> --}}
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" class="form-control form-control-sm @error('keterangan') is-invalid  @enderror" id="keterangan"  placeholder="Masukkan Keterangan" name="keterangan" value="{{ old('keterangan') }}">
            @error('keterangan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
         
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control form-control-sm @error('tanggal') is-invalid  @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
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
            <div class="card">
              <div class="card-header">
                <label for="isi">Materi yang dibahas</label>
              </div>
              <ul class="list-group list-group-flush">
                  @foreach ($noteContents as $index => $noteContent)
                    <li class="list-group-item pl-2 d-flex" >
                        {{ $loop->iteration }}. 
                        <textarea wire:model="noteContents.{{ $index }}" rows="3" type="text" class="mx-1 form-control form-control-sm @error('isi[{{ $index }}]') is-invalid  @enderror" name="isi[{{ $index }}]">{{ old('isi.'.$index) }}</textarea>
                        <button class="btn btn-sm btn-danger" style="height: 50%"  wire:click.prevent="removeContent({{$index}})" ><i class="bi bi-trash"></i></button>  
                        @error('isi[{{ $index }}]')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </li>
                  @endforeach
                  <li class="list-group-item">
                      <button class="btn btn-sm btn-secondary" wire:click.prevent="addContent" >+ Tambah Materi Yang Dibahas</button>
                  </li>
              </ul>
            </div>
          </div>
            
          <div class="form-group mt-2 mb-5">
            <button type="submit" class="btn btn-primary mb-5">Simpan</button>
          </div>
      </form>
      
</div>
