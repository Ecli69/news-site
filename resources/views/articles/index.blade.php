@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Все новости</h1>
    <div class="news-list">
        @foreach($texts as $text)
            <article>
                <h2>{{ $text->heading }}</h2>
                <p>Категория: {{ $text->category->name }}</p>
                <p>Автор: {{ $text->user->login ?? 'Неизвестен' }}</p>
                <p>{{ Str::limit($text->text, 200) }}</p>
            </article>
        @endforeach
    </div>
@endsection

@foreach($texts as $text)
    <article>
        <h2>
            <a href="{{ route('articles.show', $text->id) }}">
                {{ $text->heading }}
            </a>
        </h2>
        <p>Категория: {{ $text->category->name }}</p>
        <p>Автор: {{ $text->user->login ?? 'Неизвестен' }}</p>
        <p>{{ Str::limit($text->text, 200) }}</p>
    </article>
@endforeach