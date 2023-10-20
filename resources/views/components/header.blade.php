@guest
<a href="{{ route('userlogin') }}">Войти</a>
<a href="{{ route('register') }}">Регистрация</a>
@endguest
@auth
<a href="{{ route('logout') }}">Выйти</a>

@endauth