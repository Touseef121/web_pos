@extends('layout')

@section('title')
    Home - POS
@endsection

@section('content')
<body class="background" style="background-image: url(images/login-background.jpg); background-size:cover;">
    <div class="container" style="margin-top: 35vh;">
        <div class="jumbotron"  style="display: flex; justify-content:center; border-radius:30px;">
            <form action="{{route('login.page')}}">
                <button type="submit" class="animated-button">
                    <svg class="arr-2" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 576 512">
                    <path
                    d="M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80l0 48c0 17.7 14.3 32 32 32s32-14.3 32-32l0-48C576 64.5 511.5 0 432 0S288 64.5 288 144l0 48L64 192c-35.3 0-64 28.7-64 64L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-192c0-35.3-28.7-64-64-64l-32 0 0-48z" />
                </svg>
                <span class="text">Log in</span><span class="circle"></span>
                <svg class="arr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                    d="M144 144l0 48 160 0 0-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192l0-48C80 64.5 144.5 0 224 0s144 64.5 144 144l0 48 16 0c35.3 0 64 28.7 64 64l0 192c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 256c0-35.3 28.7-64 64-64l16 0z" />
                </svg>
            </button>
        </form>
        </div>
    </div>
</body>
@endsection
