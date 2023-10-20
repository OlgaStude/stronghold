<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>
    @include('components/header')


    <form action="{{ route('login') }}" method="post">
    @csrf    
    <input type="text" name="login" placeholder="Логин">
    @error('login')
    <p class="error">{{ $message }}</p>
    @enderror
    <input type="password" name="password" placeholder="Пароль">
    @error('password')
    <p class="error">{{ $message }}</p>
    @enderror
    @error('formError')
    <p class="error">{{ $message }}</p>
    @enderror
    <button type="submit">Авторизироваться</button>
    </form>
</body>
</html>