@extends('layouts.app')

@section('title', __('Edit Password'))

@section('content')
    <div class="container">

        @include('partials.mypage_tabs')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Password') }}</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('pass.edit') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="old-password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
                                <div class="col-md-6">
                                    <input id="old-password" type="password" class="form-control
                                            @error('old-password') is-invalid @enderror" name="old-password"
                                           required autocomplete="old-password">
                                    @error('old-password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new-password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control
                                            @error('new-password') is-invalid @enderror" name="new-password"
                                           required autocomplete="new-password">
                                    @error('new-password')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new-password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
                                <div class="col-md-6">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Change') }}
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
