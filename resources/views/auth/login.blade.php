@extends('layouts.app')

@section('content')
<style>
    .auth-container { max-width: 500px; margin: 50px auto; padding: 30px; background: #f4f1ed; border-radius: 15px; color: #333; }
    .auth-container h1 { font-family: serif; text-align: center; color: #888; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
    .form-group input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; box-sizing: border-box; }
    .btn-submit { width: 100%; padding: 15px; background: #5a5a5a; color: white; border: none; border-radius: 10px; cursor: pointer; font-size: 16px; }
</style>

<div class="container auth-container">
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
        </div>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <button type="submit" class="btn-submit">Login</button>
        <p style="text-align: center; margin-top: 20px;">
            Belum punya akun? <a href="{{ route('register') }}" style="color: #007bff;">Register di sini</a>
        </p>
    </form>
</div>
@endsection
