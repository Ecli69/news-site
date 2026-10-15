@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <h1>Регистрация</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div>
            <label for="login">Логин:</label>
            <input type="text" name="login" id="login" value="{{ old('login') }}" required>
            @error('login') <span>{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" required>
            @error('password') <span>{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="password_confirmation">Подтверждение пароля:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        
        <button type="submit">Зарегистрироваться</button>
    </form>
@endsection