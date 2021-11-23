<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    
    {{-- {{ $notes->links() }} --}}

    <div class="row">
        <div class="col">
            <select wire:model="pageNumber" class="form-select col-lg-4 col-md-4 col-sm-2" name="" id="" >
                <option selected disabled>Note Per Halaman</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="col">
            <form action="/notes">
                <div class="input-group mb-3 shadow-sm">
                    <input wire:model="search" type="text"  class="form-control" placeholder="Cari" name="cari" value="{{ request('cari') }}">
                    {{-- <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="submite">Cari</button>
                    </div> --}}
                  </div>
            </form>
        </div>
    </div>    

    <div class="d-flex justify-content-center">
        {{ $notes->onEachSide(0)->links() }}
    </div>

    @if ($notes->count())

    @foreach ($notes as $note)              

        <div class="card mb-3 shadow-sm small" >

            @if ($navnote != '')
            <div class="card-header bg-secondary text-white small justify-content-between">
                <div class=" d-flex justify-content-between">
                    <div>
                        @if ($note->user)
                            Oleh <a href="/users/{{ $note->user->slug }}" class="text-decoration-none text-white">{{ $note->user->name }}</a>  
                    
                        @else
                            Ditulis oleh Anonim 
                        @endif 
                    </div>
                    <div>
                        <small>{{ $note->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
            @endif

            <a href="/notes/{{ $note->slug }}" class="text-decoration-none text-reset">
                <div class="card-body small">
                <h6 class="card-title "> 
                    {{ $note['judul'] }}
                    @if (count($note->updateHistories))
                    <span class="badge bg-info text-white text-small">Diedit {{ count($note->updateHistories) }} kali</span>
                    @endif
                </h6>
                <p class="card-subtitle  mb-2 "> {{ $note->pemimpin }}, pada {{ App\Http\Controllers\NoteController::tanggal_indo($note->tanggal, true) }}</p>

    
                @if ($navnote == 'trash' || $navnote == 'alltrash')  
                    @can('restore', $note)
                        <a href="/notes/restore/{{ $note->slug }}" class="btn btn-success btn-sm small" onclick="return confirm('Anda yakin ingin merestore Note ini?')">Restore Note</a>  
                    @endcan 
                    @can('forceDelete', $note)
                        <a href="/notes/forceDelete/{{ $note->slug }}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus permanen Note ini?')">Delete Permanent</a>
                    @endcan
                @endif

                @can('update', $note)
                    <a href="/notes/{{ $note['slug'] }}/edit" class="btn btn-sm btn-info"><small> Ubah</small></a>  
                @endcan

                @can('delete', $note)
                    <form action="/notes/{{ $note->id }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus Note ini?')"><small>Hapus</small></button>
                    </form>
                @endcan
                </div>
            </a>

            @if ($navnote == 'my')
                <div class="card-footer text-muted">
                    <small>{{ $note->created_at->diffForHumans() }}</small>
                </div>
            @endif
        </div>  
        
        
    @endforeach

    @else
    <div class="row text-center mt-4">
       <h5>
           Tidak ada Note
       </h5> 
    </div>
    @endif

    <div class="d-flex justify-content-center  mb-5">
        {{ $notes->onEachSide(0)->links() }}
    </div>
    
</div>
