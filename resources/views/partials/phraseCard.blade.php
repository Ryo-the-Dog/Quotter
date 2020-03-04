<div class="phrase-card
@if(Route::currentRouteName() == 'phrases.show') phrase-detail-page col-lg-8
@else col-lg-6 @endif">
    <div class="card rounded-0 ">
        <div class="card-body phrase-card__body">
            <div class="flex phrase-card__main">
                <div class="phrase-card__phraseArea">
                    <i class="fas fa-quote-left"></i>
                    <p class="card-title phrase-card__phrase">{{$phrase->phrase}}</p>
                </div>
                <div class="phrase-card__img ml-auto">
                    @if($phrase->title_img_path == null)
                        <img src="/storage/img/noimg.png" alt="{{$phrase->title}}">
                    @else
                        <img src="{{ asset('/storage/img/'.$phrase->title_img_path) }}" alt="{{$phrase->title}}">
                    @endif
                </div>
            </div>
            <p class="phrase-card__title">「{{$phrase->title}}」</p>
            <div class="container">
                <div class="row">
                    <div class="card-menu-left mr-auto">
                        <a href="{{route('phrases.show',$phrase->id)}}" class="phrase-card__link">詳細</a>
                        &nbsp;&nbsp;&nbsp;
                        @forelse($phrase->tags as $tag)
                            <a href="{{ route('phrases', ['tag_id' => $tag->id]) }}" class="phrase-card__link">
                                {{ $tag->name }}
                            </a>
                            &nbsp;
                        @empty
                            <p>カテゴリーがありません</p>
                        @endforelse
                    </div>
                    <div class="card-menu-right">
                        <a href="http://twitter.com/intent/tweet?
                        url=https://ryonexta.com/portfolio/
                        &text={{$phrase->phrase}}「{{$phrase->title}}」
                        &related=ryonextStandard&hashtags=Phrase" class="twitter-btn card-menu-right__btn">
                            <i class="fab fa-twitter"></i>
                        </a>
                        @guest
                            <like
                                :phrase-id="{{ json_encode($phrase->id) }}"
                                :default-count="{{json_encode(count($phrase->likes))}}"
                            >
                            </like>
                        @else

                            <like
                                :phrase-id="{{ json_encode($phrase->id) }}"
                                :user-id="{{json_encode($userAuth->id)}}"
                                :default-liked="{{json_encode($phrase->likes->where('user_id', $userAuth->id)->first())}}"
                                :default-count="{{json_encode(count($phrase->likes))}}"
                            >
                            </like>
                        @endguest
                        @if(Route::currentRouteName() == 'phrases.mypage' )
                            <form action="{{route('phrases.delete', $phrase->id)}}" method="post" class="d-inline">
                                @csrf
                                <button class="delete-btn card-menu-right__btn" onclick="return confirm('このフレーズを削除してよろしいですか？')">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @if(Route::currentRouteName() == 'phrases.show' )
            <div class="phrase-profile" >
                <div class="phrase-profile__img">
                    @if($userAuth->profile_img_path == null)
                        <img src="/storage/img/noimg.png" alt="{{$userAuth->name}}">
                    @else
                        <img src="{{ asset('/storage/img/'.$userAuth->profile_img_path) }}" alt="{{$userAuth->name}}">
                    @endif
                </div>
                <p class="phrase-profile__name">{{$userAuth->name}}</p>
                <p class="phrase-profile__date">{{$phrase->updated_at->format('Y/m/d')}}</p>
                <span>の投稿</span>
            </div>
            @endif
        </div>
    </div>
</div>
