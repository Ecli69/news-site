<header>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Главная</a></li>
            <li><a href="{{ route('categories.index') }}">Категории</a></li>

            @auth
                @if(auth()->user()->role_id >= 2)
                    <li><a href="{{ route('articles.create') }}">Журналист</a></li>
                @endif

                @if(auth()->user()->role_id == 3)
                    <li><a href="{{ route('admin.index') }}">Админка</a></li>
                @endif

                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Выйти ({{ auth()->user()->login }})</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Вход</a></li>
                <li><a href="{{ route('register') }}">Регистрация</a></li>
            @endauth
        </ul>
    </nav>
</header>