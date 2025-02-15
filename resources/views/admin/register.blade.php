@extends('layout')

@section('title', 'Admin Register')

@section('content')

    <h1>Admin Registration</h1>

    <form method="POST" action="{{ route('admin.register') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" >
            @error('first_name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="last_name">
        @error('last_name')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" >
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


@endsection
