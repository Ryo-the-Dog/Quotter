@extends('layouts.app')

@section('title', __('My Quote List'))

@section('content')
    <div class="container">

        @include('partials.mypage_tabs')

{{--        <h2>{{ __('My Phrase List') }}</h2>--}}
{{--        <div class="container">--}}
        <div class="row">
            @forelse($phrases as $phrase)

            @include('partials.phraseCard')

            @empty
                <p class="col-lg-6">投稿したクオートはありません。</p>
            @endforelse
        </div>
{{--        </div>--}}
    </div>
@endsection
