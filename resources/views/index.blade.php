@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Phrase List') }}</h2>

        <div class="row">
{{--            @dd($list)--}}
            @forelse($list as $phrase)
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <i class="fas fa-quote-left"></i>
                                <p class="card-title">{{$phrase->phrase}}</p>
                            </div>
                            <div class="col-3">

                                @if($phrase->title_img_path == null)
                                    <img src="/storage/img/noimg.png" alt="{{$phrase->title}}" style="width: 100%;">
                                @else
                                    <img src="{{ asset('/storage/img/'.$phrase->title_img_path) }}" alt="{{$phrase->title}}" style="width: 100%;">
                                @endif
                            </div>
                        </div>
                        <p>「{{$phrase->title}}」</p>
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
                        </form>
                        @endif
                        <a href="{{route('phrases.show',$phrase->id)}}">詳細</a>
                        &nbsp;&nbsp;
                        {{--                        @dd($phrase->id) // 4 --}}
                        @forelse($phrase->tags as $tag)
{{--                        @dd($phrase->tags->id)--}}
                        <a href="{{ route('phrases', ['tag_id' => $tag->id]) }}">
                            {{ $tag->name }}
                        </a>
                            &nbsp;&nbsp;
                        @empty
                            <p>カテゴリーがありません</p>
                        @endforelse
                        <a href="http://twitter.com/intent/tweet?url=https://ryonexta.com/portfolio/&text={{$phrase->phrase}}「{{$phrase->title}}」&related=ryonextStandard&hashtags=Phrase">
                            <i class="fab fa-twitter"></i>
                        </a>
                        @guest
                        <like
                            :phrase-id="{{ json_encode($phrase->id) }}"
                        >
                        </like>
                        @else
                        <like
                            :phrase-id="{{ json_encode($phrase->id) }}"
                            :user-id="{{json_encode($userAuth->id)}}"
                            :default-liked="{{json_encode($defaultLiked)}}"
                        >
                        </like>
                        @endguest
                    </div>
                </div>
            </div>
            @empty
                <p>投稿がありません</p>
            @endforelse

{{--            @dump($phrases)--}}
        </div>
        {{ $list->links() }}
    </div>
@endsection
