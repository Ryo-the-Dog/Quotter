{{--フレーズの新規登録画面--}}
@extends('layouts.app')

@section('title', __('Quote Register'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">{{__('Quote Register')}}</div>

                    <div class="card-body">
                        <form action="{{route('phrases.new')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- クオートのタイトル -->
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Title') }}
                                </label>
                                <div class="col-md-6">
                                    <input class="form-control @error('title') is-invalid @enderror" id="title"
                                           name="title" value="{{old('title')}}"
                                           required autocomplete="title" autofocus type="text"
                                           placeholder="30文字以内" maxlength="30">
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- クオートの画像 -->
                            <div class="form-group row">
                                <label for="title_img_path" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Title Image') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control file-input @error('title_img_path') is-invalid @enderror" id="title_img_path"
                                           name="title_img_path" value="{{old('title_img_path')}}" >
                                    {{-- エラーがあった時に@error内のHTMLが表示される(この例はBootstrapの書き方) --}}
                                    @error('title_img_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror

                                    <Quoteimagepreview></Quoteimagepreview>

                                </div>
                            </div>

                            <!-- 引用するフレーズ -->
                            <div class="form-group row">
                                <label for="phrase" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Quote Phrase') }}

                                </label>

                                <div class="col-md-6">
                                    <textarea class="form-control c-input--new-quote @error('phrase') is-invalid @enderror"
                                              id="phrase" name="phrase"
                                              required maxlength="80"
                                              autocomplete="phrase" autofocus type="text"
                                              placeholder="80文字以内" v-model="strLength">{{old('phrase')}}
                                    </textarea>

                                    @error('phrase')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- カテゴリー -->
                            <div class="form-group row">
                                <label for="category1" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Category1') }}
                                </label>
                                <div class="col-md-6">
                                    <select name = "tag_ids[]" class = "form-control" id = "category1" multiple>
                                        @foreach($all_tags_list as  $all_tags)
                                            @if($loop->index >= 3)
                                                @break
                                            @endif
                                            <option value = "{{$all_tags->id}}" @if($loop->index == 0) selected @endif>{{$all_tags->name}}</option>
                                        @endforeach
                                    </select>
                                    {{-- エラーがあった時に@error内のHTMLが表示される(この例はBootstrapの書き方) --}}
                                    @error('tag_ids[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category2" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Category2') }}
                                </label>
                                <div class="col-md-6">
                                    <select name = "tag_ids[]" class = "form-control" id = "category2" multiple>
                                        @foreach($all_tags_list as  $all_tags)
                                            @if($loop->index == 0 || $loop->index == 1 || $loop->index == 2 )
                                                @continue
                                            @endif
                                            <option value = "{{$all_tags->id}}" @if($loop->index == 3) selected @endif>{{$all_tags->name}}</option>
                                        @endforeach
                                    </select>
                                    {{-- エラーがあった時に@error内のHTMLが表示される(この例はBootstrapの書き方) --}}
                                    @error('tag_ids[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Post') }}
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
