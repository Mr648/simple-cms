@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                {{$posts->links()}}
            </div>
            <br>
            <br>
            <div class="card-columns">
                @foreach($posts as $post)
                    <div class="card">

                        @if(!is_null($post->image))
                            <img class="card-img-top mx-auto d-block mt-1" src="{{$post->image}}"
                                 alt="{{$post->title}}">
                            <hr>
                        @endif
                        <div class="card-body">
                            <div class="card-title">{{$post->title}}</div>
                            <p class="card-text">{{$post->excerpt}}</p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Total Comments: {{$post->comments_count}}</p>
                            <a target="_blank" href="{{ route('posts.show',['post'=>$post->slug]) }}"
                               class="btn btn-dark">Show</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-8 text-center">
                {{$posts->links()}}
            </div>
        </div>
    </div>
@endsection
