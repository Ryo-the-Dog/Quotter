@extends('layouts.app')

@section('title', __('My Quote List'))

@section('content')
    <div class="container">

        @include('partials.mypage_tabs')

{{--        <h2>{{ __('My Phrase List') }}</h2>--}}
        <div class="row">
            @forelse($phrases as $phrase)

            @include('partials.phraseCard')

            @empty
                <p>あなたが投稿したフレーズはありません。</p>
            @endforelse
        </div>

    </div>
@endsection
