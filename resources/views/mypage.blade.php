@extends('layouts.app')

@section('content')
    <div class="container">
{{--        <a class="dropdown-item" href="{{ route('delete') }}"--}}
{{--           onclick="event.preventDefault();--}}
{{--                    document.getElementById('delete-form').submit();--}}
{{--                    alert('会員登録を解除してよろしいですか？');">--}}
{{--            {{ __('User Delete') }}--}}
{{--        </a>--}}
        <a href="{{ route('user.delete') }}">{{ __('User Delete') }}</a>

{{--        <form id="delete-form" action="{{ route('delete') }}" method="POST" style="display: none;">--}}
{{--            @csrf--}}
{{--        </form>--}}
        <h2>{{ __('My Phrase List') }}</h2>
        <div class="row">
            @foreach($phrases as $phrase)
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
{{--                            <h3 class="card-title">{{$phrase->phrase}}</h3>--}}
                            <p style="font-weight: bold;">{{$phrase->phrase}}</p>
                            <p>{{$phrase->title}}</p>
                            @if($phrase->title_img_path == null)
                                <img src="/storage/img/noimg.png" alt="{{$phrase->title}}" height="150">
                            @else
                                <img src="{{ asset('/storage/img/'.$phrase->title_img_path) }}" alt="{{$phrase->title}}" height="150">
                            @endif

                            {{-- TODO ゴミ箱ボタン --}}
                            @if(Route::currentRouteName() == 'phrases.mypage' )
                                <form action="{{route('phrases.delete', $phrase->id)}}" method="post" class="d-inline">
                                    @csrf
                                    {{--                            <button class="btn btn-danger" onclick="return confirm('このフレーズを削除してよろしいですか？')">--}}
                                    {{--                                {{__('Delete')}}--}}
                                    {{--                            </button>--}}
                                    <button class="btn" onclick="return confirm('このフレーズを削除してよろしいですか？')">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    {{-- キャッチ、セーブ、クリップ、付箋(=タグ)、ストック、アーカイブ、メモリー、マイリスト、マイフレーズ、 --}}
{{--                                    <i class="fas fa-download"></i>--}}
{{--                                    <i class="far fa-save"></i>--}}
{{--                                    <i class="far fa-clipboard"></i>--}}
{{--                                    <i class="fas fa-hands"></i>--}}
{{--                                    <i class="fas fa-hand-holding"></i>--}}
                                    <i class="fas fa-heart"></i>
                                    <i class="far fa-heart"></i>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
