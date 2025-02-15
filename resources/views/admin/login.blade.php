@extends('layout')



@section('title', 'Admin Login')



@section('content')
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1>Admin Login</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
          @error('email')
            <p style="color: red;">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" >
          @error('password')
            <p style="color: red;">{{ $message }}</p>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    <p class="mt-3">
        Don't have an account? <a href="{{ url('/admin/register') }}">Register here</a>
    </p>

@endsection
