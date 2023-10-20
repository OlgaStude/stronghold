<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
@include('components/header')
    
    <form action="" method="post">
        <select name="" id="">
            @foreach($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach

        </select>
    </form>

    <form action="{{ route('addcategory') }}" method="post">
    @csrf  
        <input type="text" name="name" placeholder="Название категории">
        <button type="submit">Добавить категорию</button>
    </form>

</body>
</html>