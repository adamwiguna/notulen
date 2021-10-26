
<ul class="nav nav-tabs justify-content-center mb-3">

        <li class="nav-item">
        <a class="nav-link {{ ($navnote == 'my') ?  'active fw-bold '  : 'text-secondary'}}" href="/note/my">Saya</a>
        </li>
        @can('viewNotesByDivision', \App\Models\Note::class)
            <li class="nav-item">
            <a class="nav-link {{ ($navnote == 'division') ?  'active fw-bold '  : 'text-secondary'}}" href="/notes/division">{{ isset(auth()->user()->division->name) ? auth()->user()->division->name : '' }}</a>
            </li>
        @endcan

        @can('viewAllNotes', \App\Models\Note::class)
            <li class="nav-item">
            <a class="nav-link {{ ($navnote == 'all') ?  'active fw-bold '  : 'text-secondary'}}"  href="/notes">Semua</a>
            </li>
        @endcan

        @can('viewNewNotes', \App\Models\Note::class)
            <li class="nav-item">
            <a class="nav-link {{ ($navnote == 'new') ?  'active fw-bold '  : 'text-secondary'}}"  href="/note/new">
                Baru
                <span class="badge bg-danger">{{ App\Http\Controllers\NoteController::countNewNotes() }}</span>
            </a>
            </li>
        @endcan

      
</ul>

