@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Phrase List') }}</h2>
        <div class="row">
            @foreach($phrases as $phrase)
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{$phrase->phrase}}</h3>
                        <p>{{$phrase->title}}</p>
                        @if($phrase->title_img_path == null)
                            <img src="/storage/img/noimg.png" alt="{{$phrase->title}}" height="150">
                        @else
                            <img src="{{ asset('/storage/img/'.$phrase->title_img_path) }}" alt="{{$phrase->title}}" height="150">
                        @endif
                        <form action="{{route('phrases.delete', $phrase->id)}}" method="post" class="d-inline">
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('このフレーズを削除してよろしいですか？')">
                                {{__('Delete')}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
@endsection
