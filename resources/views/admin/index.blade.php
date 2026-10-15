@extends('layouts.app')

@section('title', 'Админ-панель')

@section('content')
    <h1>Админ-панель</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h2>Управление статьями</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Категория</th>
                <th>Автор</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($texts as $text)
                <tr>
                    <td>{{ $text->id }}</td>
                    <td>
                        <a href="{{ route('articles.show', $text->id) }}">{{ $text->heading }}</a>
                    </td>
                    <td>{{ $text->category->name }}</td>
                    <td>{{ $text->user->login ?? 'Неизвестен' }}</td>
                    <td>
                        <a href="{{ route('admin.articles.edit', $text->id) }}">Редактировать</a>

                        <form action="{{ route('admin.articles.destroy', $text->id) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Удалить статью «{{ $text->heading }}»?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Статей пока нет.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>Управление пользователями</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <select name="role_id">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit">Изменить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection