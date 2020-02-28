@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('phrases.mypage') }}">{{ __('My Phrase List') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('phrases.like') }}">{{ __('Favorite Phrases') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.delete') }}">{{ __('User Delete') }}</a>
            </li>
        </ul>
        <h2>{{ __('Favorite Phrase List') }}</h2>
        <div class="row">
            @forelse($phrases as $phrase)
                <div class="col-sm-6">
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
                                    <button class="btn" onclick="return confirm('このフレーズを削除してよろしいですか？')">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                            <a href="{{route('phrases.show',$phrase->id)}}">詳細</a>
                            &nbsp;&nbsp;&nbsp;
                            @forelse($phrase->tags as $tag)
                                <a href="{{ route('phrases', ['tag_id' => $tag->id]) }}">
                                    {{ $tag->name }}
                                </a>
                                &nbsp;
                            @empty
                                <p>カテゴリーがありません</p>
                            @endforelse
                            <a href="http://twitter.com/intent/tweet?url=https://ryonexta.com/portfolio/&text={{$phrase->phrase}}「{{$phrase->title}}」&related=ryonextStandard&hashtags=Phrase">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <like
                                :phrase-id="{{ json_encode($phrase->id) }}"
                                :user-id="{{json_encode($userAuth->id)}}"
                                :default-liked="{{json_encode($phrase->likes->where('user_id', $userAuth->id)->first())}}"
                                :default-count="{{json_encode(count($phrase->likes))}}"
                            >
                            </like>
                        </div>
                    </div>
                </div>
            @empty
                <p>あなたがいいねしたフレーズはありません。</p>
            @endforelse
        </div>
        {{ $phrases->links() }}
    </div>
@endsection
