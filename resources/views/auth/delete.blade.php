@extends('layouts.app')

@section('content')
    <div class="container">

        @include('partials.mypage_tabs')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Account Delete') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('delete') }}">
                            @csrf

                            <p>あなたが投稿したフレーズやいいねした履歴がすべて削除されます。<br>
                                アカウントを削除してよろしいですか？</p>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 userDelete-btn-area">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
