<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') | {{ config('app.name', 'Quotter') }}</title>
    @else
        <title>{{ config('app.name', 'Quotter') }}</title>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="bg-white shadow-sm">
            <nav class="navbar navbar-expand-md navbar-light ">
                <div class="container pr-lg-0 pl-lg-0">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Quotter') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <button class="btn btn-primary nav-link"><a class="text-white" href="{{ route('register') }}">{{ __('User Register') }}</a></button>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ $user->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- route内にはweb.phpのnameメソッドで定義したパスを指定する。 --}}
                                    <a class="dropdown-item" href="{{ route('phrases.mypage') }}">
                                        {{__('Mypage')}}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <button class="btn btn-primary">
                                <a href="{{ route('phrases.new') }}" style="color: white;">{{__('Post')}}</a>
                            </button>
                        @endguest
                    </ul>
                </div>
            </nav>
            {{-- TODO ヘッダーのカテゴリ制御 --}}
            @if(Route::currentRouteName() == 'phrases'  )
            <div class="navbar navbar-expand-md navbar-light">
                <div class="container pr-lg-0 pl-lg-0">
                    <ul class="navbar-nav mr-auto category-nav">
                        <li class="nav-item @if(url()->full() == 'https://laravel.app') active @endif">
                            <a class="nav-link text-black-50 category-nav__link
{{--                               @if(Route::currentRouteName() == 'phrases') active @endif"--}}
                                @if(url()->full() == 'https://laravel.app') active @endif"
                               href="{{ route('phrases') }}">
                                ALL
                            </a>
                        </li>
{{--                        @php echo url()->full(); @endphp--}}
{{--                        @dd(Request::is('?tag_id='.$tag->id));--}}
{{--                        @php echo Route::get(); @endphp--}}
{{--                        @php echo Request::route(); @endphp--}}
                        @forelse($tag_list as $tag)
                            @if($loop->index == 3)
                                {{--                    @dd($tag->id)--}}
                            @endif
{{--                        @dd( Request::is('/?tag_id=1') );--}}
                            <li class="nav-item @if(url()->full() == 'https://laravel.app/?tag_id='.$tag->id) active @endif">
                                <a class="nav-link text-black-50 category-nav__link
                                   @if(url()->full() == 'https://laravel.app/?tag_id='.$tag->id) active @endif"
                                   href="{{ route('phrases', ['tag_id' => $tag->id]) }}">
                                    {{ $tag->name }}
                                </a>
                            </li>
                        @empty
                            <p>カテゴリーがありません</p>
                        @endforelse
                    </ul>
                    <ul class="navbar-nav m-auto sort-nav">
                        <li>
                            <a class="nav-link text-black-50 sort-nav__link"
                                href="{{ route('phrases', ['sort_id' => 'desc']) }}">
                                いいね順
                            </a>
                        </li>
                        <select name="narabi">
                            <option value="asc">昇順</option>
                            <option value="desc">降順</option>
                        </select>
                    </ul>
                </div>
            </div>
            @else
            @endif
        </header>
        @if (session('flash_message'))
            <div class="alert alert-primary text-center" role="alert">
                {{ session('flash_message') }}
            </div>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
