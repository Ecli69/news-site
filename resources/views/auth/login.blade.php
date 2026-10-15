@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <h1>Вход</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div>
            <label for="login">Логин:</label>
            <input type="text" name="login" id="login" value="{{ old('login') }}" required>
            @error('login') <span>{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" required>
        </div>
        
        <button type="submit">Войти</button>
    </form>
@endsection