@extends('layouts.app')

@section('title', $text->heading)

@section('content')
    <article class="article-full">
        <h1>{{ $text->heading }}</h1>

        <p class="meta">
            <strong>Категория:</strong>
            <a href="{{ route('categories.show', $text->category_id) }}">
                {{ $text->category->name }}
            </a>
        </p>

        <p class="meta">
            <strong>Автор:</strong> {{ $text->user->login ?? 'Неизвестен' }}
        </p>

        <p class="meta">
            <strong>Опубликовано:</strong>
            {{ $text->created_at->format('d.m.Y H:i') }}
        </p>

        <hr>

        <div class="article-body">
            {!! nl2br(e($text->text)) !!}
        </div>

        <p>
            <a href="{{ route('home') }}">← Вернуться на главную</a>
        </p>
    </article>
@endsection