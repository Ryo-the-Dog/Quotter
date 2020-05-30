@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @forelse($list as $phrase)

                @include('partials.quoteCard')

            @empty
                <p class="col-lg-6">投稿がありません</p>
            @endforelse
        </div>

        @if ( $list->hasPages() )
            {{ $list->links() }}

        @elseif(count($list) !== 0 )
            <ul class="c-pagination">
                <li aria-disabled="true" aria-label="« Previous" class="c-pagination__page-item disabled">
                    <span aria-hidden="true" class="c-pagination__page-link">‹</span>
                </li>
                <li aria-current="page" class="c-pagination__page-item active">
                    <span class="c-pagination__page-link">1</span>
                </li>
                <li aria-disabled="true" aria-label="Next »" class="c-pagination__page-item disabled">
                    <span aria-hidden="true" class="c-pagination__page-link">›</span>
                </li>
            </ul>
        @endif

    </div>
@endsection
