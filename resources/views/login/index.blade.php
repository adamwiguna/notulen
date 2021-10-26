<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <title>{{ $title }}</title>
</head>
<body class="bg-light m-5 justify-content-center">

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>   
@endif

@if (session()->has('loginError'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('loginError') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>   
@endif
<div class="col-sm-4 align-items-center justify-content-center mx-auto">
<div class="mx-auto">
<form class="form-signin text-center" action="/login" method="post">
    @csrf
    <img class="mb-4 mt-4 justify-content-center ju" src="Lambang_Kabupaten_Tabanan.png" alt="" width="150" height="150">
    <h1 class="h3 mb-3 font-weight-normal">Login</h1>
    <label for="inputEmail" class="sr-only">User</label>
    <input type="text" id="email" class="form-control mb-3" placeholder="User" required autofocus="" name="email" value="{{ old('email') }}">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="password" class="form-control mb-3" placeholder="Password" required name="password">
    {{-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> --}}
    <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
    <p class="mt-5 text-muted">© 2021 <br>Tabanan Command Center</p>
</form>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>