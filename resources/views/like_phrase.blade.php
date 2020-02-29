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

            @include('partials.phraseCard')

            @empty
                <p>あなたがいいねしたフレーズはありません。</p>
            @endforelse
        </div>
        {{ $phrases->links() }}
    </div>
@endsection
