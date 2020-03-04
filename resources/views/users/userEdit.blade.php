@extends('layouts.app')

@section('title', __('Edit Profile'))

@section('content')
    <div class="container">

{{--        <ImageTest></ImageTest>--}}

        @include('partials.mypage_tabs')

{{--        <div id="file-preview">--}}
{{--            　　<div class="form-group">--}}
{{--                　　　　<label class="form-label" for="photo_id">プロフィール画像</label><br/>--}}
{{--                　　　　<input class="form-input" type="file" name="photo_id" accept="image/*" v-on:change="onFileChange">--}}
{{--                　　</div>--}}
{{--            　　<img class="userInfo__icon" v-bind:src="imageData" v-if="imageData" alt="">--}}
{{--        </div>--}}

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.edit') }}"  enctype="multipart/form-data">
                            <div class="profile-img">
                                @csrf
                                @if($auth->profile_img_path == null)
                                    <img src="/storage/img/noimg.png" alt="{{$auth->name}}">
                                @else
                                    <img src="{{ asset('/storage/img/'.$auth->profile_img_path) }}" alt="{{$auth->name}}">
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="profile_img_path" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Profile Image') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control @error('profile_img_path') is-invalid @enderror" id="profile_img_path"
                                           name="profile_img_path"
                                           value="@if(!empty(old('profile_img_path') ) ){{old('profile_img_path')}}
                                           @elseif(!empty($auth) ){{ $auth->profile_img_path }}@endif" >
                                    {{-- エラーがあった時に@error内のHTMLが表示される(この例はBootstrapの書き方) --}}
                                    @error('profile_img_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="profile_img_path" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Profile Image') }}
                                </label>
                                <div class="col-md-6">
{{--                                    <div id="img-prev">--}}
{{--                                    <input type="file" class="form-control @error('profile_img_path') is-invalid @enderror" id="profile_img_path"--}}
{{--                                           name="profile_img_path"--}}
{{--                                           v-on:change="onFileChange"--}}
{{--                                           v-preview-input="imageData"--}}
{{--                                           value="@if(!empty(old('profile_img_path') ) ){{old('profile_img_path')}}--}}
{{--                                           @elseif(!empty($auth) ){{ $auth->profile_img_path }}@endif" >--}}
{{--                                    <img class="img" id="file-preview" v-show="uploadedImage" v-bind:src="uploadedImage" alt="">--}}
{{--                                        <input class="form-input" type="file" name="photo_id" accept="image/*" v-on:change="onFileChange">--}}
{{--                                        <img class="userInfo__icon" v-bind:src="imageData" v-show="imageData" alt="">--}}

                                    {{-- エラーがあった時に@error内のHTMLが表示される(この例はBootstrapの書き方) --}}
{{--                                    </div>--}}
                                    @error('profile_img_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
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
