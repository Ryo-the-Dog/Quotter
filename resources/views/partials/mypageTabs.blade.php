<ul class="nav nav-tabs p-mypage-tabs">
    <li class="nav-item @if(Route::currentRouteName() == 'phrases.mypage') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'phrases.mypage') active @endif" href="{{ route('phrases.mypage') }}">{{ __('My Quote List') }}</a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'phrases.like') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'phrases.like') active @endif" href="{{ route('phrases.like') }}">{{ __('Favorite Quotes') }}</a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'profile.edit') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'profile.edit') active @endif" href="{{ route('profile.edit') }}">{{ __('Edit Profile') }}</a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'pass.edit') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'pass.edit') active @endif" href="{{ route('pass.edit') }}">{{ __('Edit Password') }}</a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'user.delete') active @endif">
        <a class="nav-link @if(Route::currentRouteName() == 'user.delete') active @endif" href="{{ route('user.delete') }}">{{ __('User Delete') }}</a>
    </li>

</ul>
