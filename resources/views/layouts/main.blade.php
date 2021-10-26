<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>{{ $title }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    

  <!-- Bootstrap core CSS -->
  <link href="/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
  </head>
<body>

@auth
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-small small text-wrap" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style=" text-decoration: none;">{{ auth()->user()->name }}</a>
    <ul class="dropdown-menu m-0 p-0">
      <li>
        <a class="dropdown-item m-0" href="/users/edit/password"><i class="bi bi-key"></i> Ubah Password</a>
      </li>
      <li>
        <a class="dropdown-item m-0" href="/users/edit/data"><i class="bi bi-pencil-square"></i> Ubah Data Diri</a>
      </li>
      <li>
        {{-- <form action="/logout" method="POST">
          @csrf
          <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form> --}}
      </li>
  
    </ul>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="navbar-nav w-100">
      <div class="nav-item form-control-dark px-3 mt-0 mb-0">
        <a class="nav-link   mt-0 mb-0" href="{{ route('notes') }}"> Selamat Datang Di Aplikasi Notulen</a>
      </div>

     
      <nav style="" class="bg-dark" aria-label="breadcrumb">
        <ol class="breadcrumb bg-dark small px-3 mt-0 mb-0 rounded-0 text-dark">
          <li class="breadcrumb-item"><a class="text-decoration-none text-white" href="{{ route('notes') }}"><i class="bi bi-house-door-fill"></i> Home</a></li>
          <li class="breadcrumb-item" aria-current="page"><a class="text-decoration-none text-white text-capitalize" href="#">{{ $nav }}</a></li>
          @if (isset($breadcrumb1))
          <li class="breadcrumb-item active" aria-current="page"><a class="text-decoration-none text-white text-capitalize" href="#">{{ $breadcrumb1 }}</a></li>
          @endif
        </ol>
      </nav>
  </div>
  </header>
@endauth

<div class="container-fluid">
  <div class="row">
    
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-2">
        <ul class="nav flex-column">

          <li class="nav-item">
            <a class="nav-link {{ ($nav == 'notes') ?  'active' : ''}}" href="{{route('mynote')}}" style=""><i class="bi bi-journal-text"></i> Notes</a>
          </li>
          @can('viewUsers' , \App\Models\User::class)
          <li class="nav-item">
            <a class="nav-link {{ ($nav == 'users') ?  'active' : ''}} " href="/users" style="text-decoration:none" ><i class="bi bi-people"></i> Users</a>
          </li>
          @endcan
          @can('viewHistories', \App\Models\History::class)
          <li class="nav-item">
            <a class="nav-link mb-4 {{ ($nav == 'histories') ?  'active' : ''}}" href="/histories"><i class="bi bi-clock-history"></i> Histories</a>
          </li>     
          @endcan
          
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
            <span>Keluar Aplikasi</span>
          </h6>
          <li class="nav-item">
            <form action="/logout" method="POST">
              @csrf
              <button type="submit" class="nav-link  bg-transparent border-0"><i class="bi bi-box-arrow-right"></i> Sign out</button>
            </form>
          </li>

        </ul>
      </div>
    </nav>
   

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2 mb-0" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>   
        @endif
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 align-middle">
        <a class="text-dark h2 text-decoration-none" href="{{ route('mynote') }}"> <h1 class="h2">{{ $title }}</h1></a>
       
        
        <div class="btn-toolbar mb-2 mb-md-0 align-middle">
          @if (isset($createNote))
            <a href="/notes/create/form" class="btn btn-primary btn-sm ms-auto"><i class="bi bi-file-earmark-plus"></i> Buat Notes Baru </a>
          @endif
         
          @can('create', \App\Models\User::class)
            @if ($nav == 'users')
              <a href="/users/create/form" class="btn btn-primary btn-sm ms-auto"><i class="bi bi-person-plus"></i> Buat User Baru </a>
            @endif
          @endcan
        </div>
      </div>
      
      @if (isset($downloadNote))
      <a href="/note/word-export/{{ $notes->id }}" class="btn btn-primary btn-sm mb-3"><i class="bi bi-download"></i> Download </a>
      @endif

      <div class="">
        @yield('container')
      </div>
      
    </main>
  </div>
</div>


    <script src="/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 

      {{-- <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script> --}}
  </body>
</html>
