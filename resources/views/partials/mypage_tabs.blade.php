<ul class="nav nav-tabs mypage-tabs">
    <li class="nav-item @if(Route::currentRouteName() == 'phrases.mypage') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'phrases.mypage') active @endif" href="{{ route('phrases.mypage') }}">{{ __('My Phrase List') }}</a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'phrases.like') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'phrases.like') active @endif" href="{{ route('phrases.like') }}">{{ __('Favorite Phrases') }}</a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'user.delete') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'user.delete') active @endif" href="{{ route('user.delete') }}">{{ __('User Delete') }}</a>
    </li>
</ul>
