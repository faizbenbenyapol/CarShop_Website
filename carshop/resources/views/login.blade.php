@extends('layouts.login-layout')

@section('css_before')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="border">
    <form class="container" method="POST" action="/login">
        @csrf
        <h2>LOGIN</h2>

        <input class="textbox" type="email" name="email" placeholder="email" required value="{{ old('email') }}">
        <input class="textbox" type="password" name="password" placeholder="password" required>

        @if($errors->any())
            <div class="text-danger mb-2">
                {{ $errors->first() }}
            </div>
        @endif

        <input class="submit" type="submit" value="LOGIN">

        <div>
            <a href="#">forgot</a>
            <span class="space"></span>
            <a href="">Apply</a>
        </div>
    </form>
</div>
@endsection
