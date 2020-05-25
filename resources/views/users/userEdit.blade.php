@extends('layouts.app')

@section('title', __('Edit Profile'))

@section('content')
    <div class="container">

        @include('partials.mypage_tabs')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.edit') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name" value="@if(!empty(old('name') ) ){{old('name')}}@elseif(!empty($auth) ){{$auth->name}}@endif"
                                           required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="@if(!empty(old('email') ) ){{old('email')}}@elseif(!empty($auth) ){{$auth->email}}@endif"
                                           required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profile_img_path"  class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>
                                {{-- ⭕️一応最低限登録は行える。
                                だから残りの課題は、
                                1.登録済みのプロフィール画像を取得する
                                2.表示=assetメソッドが必要
                                3.未登録の場合にはno-imgを表示する
                                4.エラーの時                         --}}
                                <ImageTest
                                :auth="{{$auth}}"
                                ></ImageTest>
                                @error('profile_img_path')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
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
