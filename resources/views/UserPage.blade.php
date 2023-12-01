<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>User</title>
</head>
<body>
@include('components/header')
<a href="{{ route('complainspage') }}">Оставьте заявку</a>
    
    <h1>Ваши заявки</h1>

    <div id="complaints_container">
        @foreach($complaints as $complaint)
            <div class="">
                <p>{{ $complaint->category_name }}</p>
                <p>{{ $complaint->created_at }}</p>
                <img src="{{ asset('storage/old_ver_imgs/'. $complaint->image_old) }}" alt="">
                <p>{{ $complaint->name }}</p>
                <p>{{ $complaint->description }}</p>
                <p>Статус: {{ $complaint->status }}</p>
                <a class="btn delete" href=" {{ url('removecomplaint/'.$complaint->complains_id) }}"><button>Удалить</button></a>
            </div>
        @endforeach
    </div>

<script>

   
        
    </script>

</body>
</html>