<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/mainPage.css')}}">
    <title>Главная</title>
</head>
<body>
<div class="container">
@include('components/header')
<section class="main_header">
    <img src="{{ asset('storage/img/gradient_1.png') }}" alt="">
    <h1>Сделаем лучше вместе!</h1>
    <p>Нашли проблему в городе? Сообщите о ней!</p>
    @guest
    <a href="{{ route('userlogin') }}"><button class="main_button">Оставить заявку</button></a>
    @endguest
    @auth
        <a href="{{ route('complainspage') }}"><button class="main_button">Оставить заявку</button></a>
    @endauth
</section>


    <p>{{ $solved }}</p>
        @foreach($complaints as $complaint)
            <div class="">
                <p>{{ $complaint->category_name }}</p>
                <p>{{ \Carbon\Carbon::parse($complaint->created_at)->format('d.m.Y') }}</p>
                <img class="foto" data-new_path="{{  asset('storage/old_ver_imgs/'. $complaint->image_old) }}" src="{{ asset('storage/new_ver_imgs/'. $complaint->image_new) }}" alt="">
                <p>{{ $complaint->name }}</p>
            </div>
        @endforeach

</div>
    <script>
        
        $('.foto').mouseenter(function(){
        //    alert($(this).data('new_path'))
            let new_path = $(this).data('new_path')
            let old_path = $(this).attr('src')
            $(this).attr('src', new_path)
            $(this).data('new_path', old_path)
        })
        $('.foto').mouseleave(function(){
        //    alert($(this).data('new_path'))
            let new_path = $(this).data('new_path')
            let old_path = $(this).attr('src')
            $(this).attr('src', new_path)
            $(this).data('new_path', old_path)
        })

       

    </script>
</body>
</html>