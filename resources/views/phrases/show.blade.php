@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Phrase Detail') }}</h2>
        <div class="row">
{{--            @foreach($phrases as $phrase)--}}
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{$phrase->phrase}}</h3>
                            <p>{{$phrase->title}}</p>
                            @if($phrase->title_img_path == null)
                                <img src="/storage/img/noimg.png" alt="{{$phrase->title}}" height="150">
                            @else
                                <img src="{{ asset('/storage/img/'.$phrase->title_img_path) }}" alt="{{$phrase->title}}" height="150">
                            @endif

                            @if(Route::currentRouteName() == 'phrases.mypage' )
                                <form action="{{route('phrases.delete', $phrase->id)}}" method="post" class="d-inline">
                                    @csrf
                                    {{--                            <button class="btn btn-danger" onclick="return confirm('このフレーズを削除してよろしいですか？')">--}}
                                    {{--                                {{__('Delete')}}--}}
                                    {{--                            </button>--}}
                                    <button class="btn" onclick="return confirm('このフレーズを削除してよろしいですか？')">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                    {{--  キャッチ、セーブ、クリップ、付箋、 --}}
                                    <i class="fas fa-download"></i>
                                    <i class="far fa-save"></i>
                                    <i class="far fa-clipboard"></i>
                                    <i class="fas fa-hands"></i>
                                    <i class="fas fa-hand-holding"></i>
                                    <i class="fas fa-heart"></i>
                                    <i class="far fa-heart"></i>
                                </form>
                            @endif
                            @guest
                            <like
                                :phrase-id="{{ json_encode($phrase->id) }}"
                                :default-count="{{json_encode($defaultCount)}}"
                            >
                            </like>
                            @else
                            <like
                                :phrase-id="{{ json_encode($phrase->id) }}"
                                :user-id="{{json_encode($userAuth->id)}}"
                                :default-liked="{{json_encode($defaultLiked)}}"
                                :default-count="{{json_encode($defaultCount)}}"
                            >
                            </like>
                            @endguest
{{--                            @dd($phrase->id) // null --}}
                        </div>
                    </div>
                </div>
{{--            @endforeach--}}
{{--            @dump($defaultLiked);--}}
        </div>

    </div>
@endsection
