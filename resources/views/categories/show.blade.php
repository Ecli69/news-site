@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <p>
        <a href="{{ route('categories.index') }}">← Все категории</a>
    </p>

    <h1>Категория: {{ $category->name }}</h1>

    @if($texts->isEmpty())
        <p>В этой категории пока нет статей.</p>
    @else
        @foreach($texts as $text)
            <article>
                <h2>
                    <a href="{{ route('articles.show', $text->id) }}">
                        {{ $text->heading }}
                    </a>
                </h2>
                <p>Автор: {{ $text->user->login ?? 'Неизвестен' }}</p>
                <p>{{ Str::limit($text->text, 200) }}</p>
            </article>
            <hr>
        @endforeach
    @endif
@endsection

@foreach($texts as $text)
    <article>
        <h2>
            <a href="{{ route('articles.show', $text->id) }}">
                {{ $text->heading }}
            </a>
        </h2>
        <p>Автор: {{ $text->user->login ?? 'Неизвестен' }}</p>
    </article>
@endforeach