@extends('layouts.app')

@section('content')
    <div class="container pl-sm-0 pr-sm-0">
{{--        <h2>{{ __('Phrase List') }}</h2>--}}

        <div class="row">
            @forelse($list as $phrase)

{{--                @if(!empty($phrase->tags))--}}
{{--                @section('title',$phrase->tags)   --}}
{{--                @endif--}}

            @include('partials.phraseCard')

            @empty
                <p>投稿がありません</p>
            @endforelse
        </div>
        {{ $list->links() }}
    </div>
@endsection
