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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Account Delete') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('delete') }}">
                            @csrf

{{--                            <div class="form-group row">--}}
{{--                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                    @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <p>あなたが投稿したフレーズやいいねした履歴がすべて削除されます。<br>
                                アカウントを削除してよろしいですか？</p>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
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
