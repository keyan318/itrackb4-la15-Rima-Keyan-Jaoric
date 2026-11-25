@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="container mt-4">
    <h2>Register</h2>

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name"
                class="form-control"
                value="{{ old('name') }}">

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
                class="form-control"
                value="{{ old('email') }}">

            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password"
                class="form-control">

            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">
                Confirm Password
            </label>

            <input type="password"
                name="password_confirmation"
                id="password_confirmation"
                class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            Register
        </button>
    </form>
</div>

@endsection