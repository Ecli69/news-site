@extends('layouts.app')

@section('title', 'Редактировать статью')

@section('content')
    <h1>Редактировать статью</h1>

    <form method="POST" action="{{ route('admin.articles.update', $text->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="heading">Заголовок:</label>
            <input type="text" name="heading" id="heading"
                   value="{{ old('heading', $text->heading) }}" required>
            @error('heading') <span style="color:red;">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="category_id">Категория:</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $text->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="text">Текст:</label>
            <textarea name="text" id="text" rows="12" required>{{ old('text', $text->text) }}</textarea>
            @error('text') <span style="color:red;">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Сохранить</button>
        <a href="{{ route('admin.index') }}">Отмена</a>
    </form>
@endsection