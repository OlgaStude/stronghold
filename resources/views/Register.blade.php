<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    @include('components/header')
    <form action="{{ route('sendUser') }}" method="post">
    @csrf    
        <input type="text" name="name" placeholder="ФИО" value="{{ old('name') }}">
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror
        <input type="text" name="login" placeholder="Логин" value="{{ old('login') }}">
        @error('login')
            <p class="error">{{ $message }}</p>
        @enderror
        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror
        <input type="password" name="password" placeholder="Пароль">
        @error('password')
            <p class="error">{{ $message }}</p>
        @enderror
        <input type="password" name="password_confirmation" placeholder="Подтвердите пароль">
        <input type="checkbox" name="check" id="check" onchange="btn_change()"><label for="check">Я татар</label>
        <button type="submit" disabled id="btn">Регистрация</button>
    </form>



    <script>

        function btn_change(){
            if(document.getElementById('btn').disabled == true){
                document.getElementById('btn').disabled = false;
            }else{
                document.getElementById('btn').disabled = true
            }
        }

    </script>

</body>
</html>