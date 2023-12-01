<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
</head>
<body>
@include('components/header')
<div id="complaints_container">
        @foreach($complaints as $complaint)
            <div class="">
                <p>{{ $complaint->category_name }}</p>
                <p>{{ \Carbon\Carbon::parse($complaint->created_at)->format('d.m.Y') }}</p>
                <img src="{{ asset('storage/new_ver_imgs/'. $complaint->image_new) }}" alt="">
                <p>{{ $complaint->name }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>