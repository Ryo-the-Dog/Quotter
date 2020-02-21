{{--フレーズの新規登録画面--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('画像登録画面')}}</div>
                    <div class="card-body">
                        <form action="{{ url('uploader') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="file" class="form-control" name="image_file">
                            <hr>
                            <button type="submit" class="btn btn-success">登録</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
