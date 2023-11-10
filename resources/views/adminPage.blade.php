<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Admin</title>
    <style>
        .declination_form{
            display: none;
        }
    </style>
</head>
<body>
@include('components/header')
    
    <div>
        <select name="" id="categories">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach

        </select>
        <button onclick="deleteCategory()">Удалить категорию</button>
    </div>

    <form action="{{ route('addcategory') }}" method="post">
    @csrf  
        <input type="text" name="name" placeholder="Название категории">
        <button type="submit">Добавить категорию</button>
    </form>

    <div id="complains_container">
        @foreach($complains as $complain)
        <div class="upper_line">
            <p>{{ $complain->category_name }}</p>
            <p>{{ $complain->status}}</p>
            <p>{{ \Carbon\Carbon::parse($complain->created_at)->format('d.m.Y') }}</p>
        </div>
        <img src="{{ asset('storage/old_ver_imgs/'. $complain->image_old) }}" alt="">
        <p>{{ $complain->name }}</p>
        <p>{{ $complain->description }}</p>
        <form action="{{ route('solved') }}" enctype="multipart/form-data" method="post">
        @csrf  

            <button class="solved_btn">Статус "Решено"</button>
            <input type="file" name="image_new">
            @error('image_new')
                <p>{{ $message }}</p>
            @enderror
            <input type="text" hidden name="id" value="{{ $complain->complains_id }}">
        </form>
        <button class="decline_btn">Отклонить заявку</button>

        <form class="declination_form" action="{{ route('decline') }}" method="post">
        @csrf  

            <textarea name="reason" placeholder="Причина отклонения"></textarea>
            <input type="text" hidden name="id" value="{{ $complain->complains_id }}">

            @if(session('fail_message') !== null)
            <p>{{ session('fail_message') }}</p>
            {{ Session::forget('fail_message') }}
        @endif
            <button class="decline">Отклонить</button>
        </form>
        @endforeach
    </div>
    
    <script>

        $('.decline_btn').click(function(){
            if($(this).next().is(':hidden')){
                $(this).next().show()
            } else {
                $(this).next().hide()
            }
        })

        function deleteCategory() {
            let id = $('#categories').val();
            $.ajax({
                    url: '{{ route("deletecategory") }}',
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data)
                    }
                
            })
        }
        
    </script>
</body>
</html>