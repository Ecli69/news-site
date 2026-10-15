@extends('layouts.app')

@section('title', 'Написать статью')

@section('content')
    <h1>Написать статью</h1>
    <form method="POST" action="{{ route('articles.store') }}">
        @csrf
        
        <div>
            <label for="heading">Заголовок:</label>
            <input type="text" name="heading" id="heading" required>
        </div>
        
        <div>
            <label for="category_id">Категория:</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="text">Текст статьи:</label>
            <textarea name="text" id="text" rows="10" required></textarea>
        </div>
        
        <button type="submit">Опубликовать</button>
    </form>
@endsection