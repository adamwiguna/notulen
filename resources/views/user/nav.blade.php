
<ul class="nav nav-tabs justify-content-center">

    @if (auth()->user()->authorization_level >= 0)
        <li class="nav-item">
        <a class="nav-link {{ ($navnote == 'my') ?  'active fw-bold '  : 'text-secondary'}}" href="/note/my">Saya</a>
        </li>
        @if (auth()->user()->authorization_level >= 1)
            <li class="nav-item">
            <a class="nav-link {{ ($navnote == 'division') ?  'active fw-bold '  : 'text-secondary'}}" href="/notes/division">Bidang</a>
            </li>
            @if (auth()->user()->authorization_level >= 2)
                <li class="nav-item">
                <a class="nav-link {{ ($navnote == 'all') ?  'active fw-bold '  : 'text-secondary'}}"  href="/notes">Semua</a>
                </li>
                @if (auth()->user()->authorization_level >= 3)
                    <li class="nav-item">
                    <a class="nav-link {{ ($navnote == 'new') ?  'active fw-bold '  : 'text-secondary'}}"  href="/note/new">Baru</a>
                    </li>
                @endif
            @endif
        @endif

    @endif

    {{-- <li class="nav-item">
    <a class="nav-link {{ ($navnote == 'new') ?  'active fw-bold '  : 'text-secondary'}}"  href="/note/new">Baru</a>
    </li>
    <li class="nav-item">
    <a class="nav-link {{ ($navnote == 'all') ?  'active fw-bold '  : 'text-secondary'}}"  href="/notes">Semua</a>
    </li>
    <li class="nav-item">
    <a class="nav-link {{ ($navnote == 'division') ?  'active fw-bold '  : 'text-secondary'}}" href="/notes/division">Bidang</a>
    </li>
    <li class="nav-item">
    <a class="nav-link {{ ($navnote == 'my') ?  'active fw-bold '  : 'text-secondary'}}" href="/note/my">Saya</a>
    </li> --}}
    @can('admin')
        <li class="nav-item">
        <a class="nav-link {{ ($navnote == 'trash') ?  'active fw-bold '  : 'text-secondary'}}" href="/note/trash">Trash</a>
        </li>  
        <li class="nav-item">
        <a class="nav-link {{ ($navnote == 'alltrash') ?  'active fw-bold'  : 'text-secondary'}}" href="/note/alltrash">Trash</a>
        </li>  
    @endcan
</ul>