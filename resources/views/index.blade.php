@extends('layouts.app')

@section('content')
    <div class="container">
{{--        <h2>{{ __('Phrase List') }}</h2>--}}

        <div class="row">
            @forelse($list as $phrase)

{{--                @if(!empty($phrase->tags))--}}
{{--                @section('title',$phrase->tags)   --}}
{{--                @endif--}}

            @include('partials.phraseCard')

            @empty
                <p class="col-lg-6">投稿がありません</p>
            @endforelse
        </div>
{{--        {{ $list->links() }}--}}
    </div>
@endsection
