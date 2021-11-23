
<ul class="nav nav-tabs justify-content-center mb-3">

        <li class="nav-item">
        <a class="nav-link {{ ($navnote == 'my') ?  'active fw-bold '  : 'text-secondary'}}" href="/note/my">Saya</a>
        </li>
{{--         
        @if ( !in_array(auth()->user()->division->name,  ['KADIS', 'SEKDIS ']))
            @can('viewNotesByDivision', \App\Models\Note::class)
                <li class="nav-item">
                <a class="nav-link {{ ($navnote == 'division') ?  'active fw-bold '  : 'text-secondary'}}" href="/notes/division">{{ isset(auth()->user()->division->name) ? auth()->user()->division->name : '' }}</a>
                </li>
            @endcan
        @endif --}}

        @can('viewAllNotes', \App\Models\Note::class)
            <li class="nav-item">
            <a class="nav-link {{ ($navnote == 'all') ?  'active fw-bold '  : 'text-secondary'}}"  href="/notes">
                Semua
                @if (App\Http\Controllers\NoteController::countNewNotes() > 0)
                <span class="badge bg-danger">{{ App\Http\Controllers\NoteController::countNewNotes() }}</span>
                @endif
            </a>
            </li>
        @endcan

        {{-- @can('viewNewNotes', \App\Models\Note::class)
            <li class="nav-item">
            <a class="nav-link {{ ($navnote == 'new') ?  'active fw-bold '  : 'text-secondary'}}"  href="/note/new">
                Baru
                @if (App\Http\Controllers\NoteController::countNewNotes() > 0)
                <span class="badge bg-danger">{{ App\Http\Controllers\NoteController::countNewNotes() }}</span>
                @endif
            </a>
            </li>
        @endcan --}}

      
</ul>

