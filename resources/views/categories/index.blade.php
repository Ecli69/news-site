@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    <h1>Все категории</h1>

    @if($categories->isEmpty())
        <p>Категорий пока нет.</p>
    @else
        <ul class="category-list">
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('categories.show', $category->id) }}">
                        {{ $category->name }}
                    </a>
                    <span>({{ $category->texts_count }} {{ trans_choice('статья|статьи|статей', $category->texts_count) }})</span>
                </li>
            @endforeach
        </ul>
    @endif
@endsection