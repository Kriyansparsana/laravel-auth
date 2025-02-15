@extends('layout')



@section('title', 'User Home')



@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-5 text-center">
        <h1 class="display-4">Task</h1>
        <p class="lead">Register as a customer or admin to get started.</p>
        <a href="{{ route('customer.register') }}" class="btn btn-primary btn-lg">Customer Register</a>
        <a href="{{ route('admin.register') }}" class="btn btn-success btn-lg">Admin Register</a>
        <a href="{{ route('admin.login') }}" class="btn btn-dark btn-lg">Admin Login</a>

    </div>

@endsection
