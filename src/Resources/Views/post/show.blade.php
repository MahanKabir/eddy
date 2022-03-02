@extends('main')

@section('content')
    <div class="container mt-5">

        @foreach($posts as $post)

            @if($post['type'] == 'text')

                <div class="col-12 text-end my-4" style="white-space: pre-line;" dir="rtl">
                    <p>{{ json_decode($post['value']) }}</p>
                </div>

            @elseif($post['type'] == 'image')

                <div class="text-end my-4">
                    <img class="rounded shadow-lg" src="{{ json_decode($post['value'])  }}" width="250">
                </div>

            @elseif($post['type'] == 'video')

                <div class="text-end my-4 section d-flex justify-content-center embed-responsive embed-responsive-21by9">
                    <video class="embed-responsive-item" width="320" height="240" controls>
                        <source src="{{ json_decode($post['value'])  }}" type="video/avi">
                        <source src="{{ json_decode($post['value'])  }}" type="video/mp4">
                    </video>
                </div>

            @elseif($post['type'] == 'album')
                <h3 class="text-end mb-4">آلبوم تصاویر</h3>
                <div class="col-12" dir="ltr">
                    <div class="gallery">
                        @foreach(json_decode($post['path']) as $path)
                            <img class="rounded shadow-lg px-3" height="360" src="{{ $path }}" >
                        @endforeach
                    </div>
                </div>

            @elseif($post['type'] == 'title')
                <div class="text-center my-4">
                    <h2>{{json_decode($post['value']) }}</h2>
                </div>

            @elseif($post['type'] == 'list')
                <div class="my-4" dir="rtl">
                    <ul>
                        @foreach(json_decode($post['value']) as $path)
                            <li class="">{{ $path }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        @endforeach

    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.gallery').slick({
            dots: false,
            slidesToShow: 2,
            centerMode: true
        });
    </script>
@stop
