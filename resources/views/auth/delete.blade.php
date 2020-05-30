@extends('layouts.app')

@section('title',__('User Delete'))

@section('content')
    <div class="container">

        @include('partials.mypageTabs')

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
                                <div class="col-md-6 ml-auto text-right">
                                    <button type="submit" class="btn btn-danger"  onclick="return confirm('本当にアカウントを削除してよろしいですか？')">
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
