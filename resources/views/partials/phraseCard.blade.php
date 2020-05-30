{{--<div class="phrase-card @if(Route::currentRouteName() == 'phrases.show') phrase-detail-page col-lg-8 @else col-lg-6 @endif">--}}

    <div class="phrase-card @if(Route::currentRouteName() == 'phrases.show') phrase-detail-page col-lg-8 @else col-lg-6 @endif card card-body phrase-card__body @if(Route::currentRouteName() === 'phrases.show') detailPage @endif">

        @if(Route::currentRouteName() === 'phrases.show')

        @else
            <!-- パネル全体をリンクにする -->
            <a href="{{route('phrases.show',$phrase->id)}}" class="phrase-card__link-large" title="クオートの詳細"></a>
        @endif

        <div class="l-flex phrase-card__main">

            <div class="phrase-card__phraseArea">
                <i class="fas fa-quote-left c-icon--quote"></i>
                <p class="card-title phrase-card__phrase">{{$phrase->phrase}}</p>
            </div>

            <div class="phrase-card__img ml-auto">
                    <img src="@if(empty($phrase->title_img_path)){{asset('/img/noimg.png')}} @else {{$phrase->title_img_path}} @endif"
                         alt="@if(empty($phrase->title_img_path)) quoteの画像 @else {{$phrase->title}} @endif">
            </div>

        </div>

        <p class="phrase-card__title">「{{$phrase->title}}」</p>

        <div class="container">
            <div class="row">
                <div class="card-menu-left mr-auto">
                    @forelse($phrase->tags as $tag)
                        <a href="{{ route('phrases', ['tag_id' => $tag->id]) }}" class="phrase-card__link category">
                            {{ $tag->name }}
                        </a>
                    @empty
                        <p>カテゴリーがありません</p>
                    @endforelse
                </div>

                <div class="card-menu-right">
                    <a href="http://twitter.com/intent/tweet?url=https://ryonexta.com/portfolio/
                    &text={{$phrase->phrase}}「{{$phrase->title}}」&related=ryonextStandard&hashtags=Quotter" class="c-btn--twitter card-menu-right__btn">
                        <i class="fab fa-twitter"></i>
                    </a>

                    <!-- いいねボタン -->
                    @guest
                        <like
                            :phrase-id="{{ json_encode($phrase->id) }}"
                            :default-count="{{json_encode(count($phrase->likes))}}"
                            :login-route="{{json_encode(route('login'))}}"
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

                    <!-- マイページ用のゴミ箱ボタン -->
                    @if(Route::currentRouteName() == 'phrases.mypage' )
                        <form action="{{route('phrases.delete', $phrase->id)}}" method="post" class="d-inline">

                            @csrf

                            <button class="c-btn--delete card-menu-right__btn" onclick="return confirm('このクオートを削除してよろしいですか？')">
                                <i class="far fa-trash-alt"></i>
                            </button>

                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- 詳細ページでは投稿者の情報を表示する -->
        @if(Route::currentRouteName() == 'phrases.show' )
            <div class="p-phrase-profile" >

                <div class="p-phrase-profile__img">
                    @if(empty($phrase->user->profile_img_path))
                        <img src="{{asset('/img/noimg.png')}}" alt="{{$phrase->user->name}}">
                    @else
                        <img src="{{$phrase->user->profile_img_path}}" alt="{{$phrase->user->name}}">
                    @endif
                </div>

                <p class="p-phrase-profile__name">{{$phrase->user->name}}</p>
                <p class="p-phrase-profile__date">{{$phrase->updated_at->format('Y/m/d')}}</p>
                <span>の投稿</span>
            </div>
        @endif

    </div>
{{--</div>--}}
