@extends('layouts.app')

@section('title', __('Favorite Quotes'))

@section('content')
    <div class="container">

        @include('partials.mypage_tabs')

{{--        <h2>{{ __('Favorite Phrase List') }}</h2>--}}
        <div class="row">
            @forelse($phrases as $phrase)

            @include('partials.phraseCard')

            @empty
                <p class="col-lg-6">いいねしたクオートはありません。</p>
            @endforelse
        </div>
        {{ $phrases->links() }}
    </div>
@endsection