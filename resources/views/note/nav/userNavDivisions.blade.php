<ul class="nav nav-pills nav-justified mb-3">
    @foreach ($divisions as $division)
    <li class="nav-item small">
      <a class="nav-link small text-decoration-none {{ (isset($navnotebydivision)) ? (( $navnotebydivision == $division->id) ? 'active' : 'text-secondary') : '' }}" aria-current="page" href="/notes/division/{{ $division->id }}">{{ $division->name }}</a>
    </li>
    @endforeach
</ul>