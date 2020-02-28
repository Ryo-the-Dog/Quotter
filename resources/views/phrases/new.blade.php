{{--フレーズの新規登録画面--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Phrase Register')}}</div>
                    <div class="card-body">
                        <form action="{{route('phrases.new')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Title') }}
                                </label>
                                <div class="col-md-6">
                                    <input class="form-control @error('title') is-invalid @enderror" id="title"
                                           name="title" value="{{old('title')}}"
                                           autocomplete="title" autofocus type="text">
                                    {{-- エラーがあった時に@error内のHTMLが表示される(この例はBootstrapの書き方) --}}
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title_img" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Title Image') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control @error('title') is-invalid @enderror" id="title_img"
                                           name="title_img"
                                           value="{{old('title_img')}}" >
                                    {{-- エラーがあった時に@error内のHTMLが表示される(この例はBootstrapの書き方) --}}
                                    @error('title_img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phrase" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Phrase') }}
                                </label>
                                <div class="col-md-6">
                                    <textarea class="form-control @error('phrase') is-invalid @enderror"
                                              id="phrase" name="phrase"
                                              value="{{old('phrase')}}" autocomplete="phrase" autofocus type="text">
                                    </textarea>
                                    {{-- エラーがあった時に@error内のHTMLが表示される(この例はBootstrapの書き方) --}}
                                    @error('phrase')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category1" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Category1') }}
                                </label>
                                <div class="col-md-6">
                                    <select name = "tag_ids[]" class = "form-control" id = "category1" multiple>
                                        @foreach($all_tags_list as  $all_tags)
                                            @if($loop->index >= 5)
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
                                            @if($loop->index == 0 || $loop->index == 1 || $loop->index == 2 || $loop->index == 3 || $loop->index == 4)
                                                @continue
                                            @endif
                                            <option value = "{{$all_tags->id}}" @if($loop->index == 5) selected @endif>{{$all_tags->name}}</option>
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
                                <label for="detail" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Detail') }}
                                </label>
                                <div class="col-md-6">
                                    <textarea class="form-control @error('detail') is-invalid @enderror"
                                              id="detail" name="detail"
                                              value="{{old('detail')}}" autocomplete="detail" autofocus type="text">
                                    </textarea>
                                    {{-- エラーがあった時に@error内のHTMLが表示される(この例はBootstrapの書き方) --}}
                                    @error('detail')
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
