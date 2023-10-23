<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявки</title>
</head>
<body>
    
    @include('components/header')
    
    <form action="{{ route('addcomplaint') }}" method="post" enctype="multipart/form-data">
    @csrf  
        <input type="text" name="name" placeholder="Название">
        <textarea name="description" id="" cols="30" rows="10" placeholder="Описание"></textarea>
        <select name="category_id" id="">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <input type="file" name="img">
        <button type="submit">Отправить заявку</button>
        @if(session('success_message') !== null)
            <p>{{ session('success_message') }}</p>
            {{ Session::forget('success_message') }}
        @endif
    </form>

    
</body>
</html>