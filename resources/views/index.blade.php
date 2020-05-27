@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @forelse($list as $phrase)

            @include('partials.phraseCard')

            @empty
                <p class="col-lg-6">投稿がありません</p>
            @endforelse
        </div>
        {{ $list->links() }}
    </div>
@endsection
