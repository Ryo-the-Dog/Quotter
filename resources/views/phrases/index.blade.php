@extends('layouts.app')

@section('content')
<h1>画像一覧</h1>

<a href="./uploader">新しい画像を登録する</a>

{{--$itemsはコントローラの方でcompactメソッドでImgモデルのデータ全て使えるにしてある。--}}
@if (count($items) > 0)
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>タイトル</th>
            <th>画像</th>
        </tr>
        </thead>
        <tbody>
        {{-- Imgモデルのデータを回す --}}
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                {{-- 画像パスをlaravelのassetメソッドを使って補完する。 --}}
                <td><img src="{{ asset('/storage/img/'.$item->file_name) }}" width="400"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>まだ画像は登録されていません。</p>

@endif

@endsection
