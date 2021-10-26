
<ul class="nav nav-tabs justify-content-center">
    {{-- <li class="nav-item">
    <a class="nav-link {{ ($navnote == 'new') ?  'active fw-bold text-uppercase'  : 'text-secondary'}}"  href="/note/new">New</a>
    </li> --}}
    <li class="nav-item">
    <a class="nav-link {{ ($navnote == 'all') ?  'active fw-bold text-uppercase'  : 'text-secondary'}}"  href="/notes">All</a>
    </li>
    {{-- <li class="nav-item">
    <a class="nav-link {{ ($navnote == 'my') ?  'active fw-bold text-uppercase'  : 'text-secondary'}}" href="/note/my">My Note</a>
    </li> --}}
    @can('admin')
        {{-- <li class="nav-item">
        <a class="nav-link {{ ($navnote == 'trash') ?  'active fw-bold text-uppercase'  : 'text-secondary'}}" href="/note/trash">Trash</a>
        </li>   --}}
        <li class="nav-item">
        <a class="nav-link {{ ($navnote == 'alltrash') ?  'active fw-bold'  : 'text-secondary'}}" href="/note/alltrash">Trash</a>
        </li>  
    @endcan
</ul>