@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Phrase List') }}</h2>

        <div class="row">
            @forelse($list as $phrase)

            @include('partials.phraseCard')

            @empty
                <p>投稿がありません</p>
            @endforelse
        </div>
        {{ $list->links() }}
    </div>
@endsection
