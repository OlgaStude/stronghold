<link rel="stylesheet" href="{{asset('css/components/header.css')}}">

<div class="header">
<a href="{{ route('name') }}"><img src="{{  asset('storage/img/logo.png') }}" alt=""></a>

@guest
<a href="{{ route('userlogin') }}" class="header_link enter">Войти</a>
<a href="{{ route('register') }}" class="header_link">Регистрация</a>
@endguest
@auth
<a href="{{ route('logout') }}" class="header_link">Выйти</a>

@endauth
</div>