@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if(!is_null($post->image))
                        <img class="card-img-top mx-auto d-block" src="{{asset($post->image)}}"
                             alt="{{$post->title}}">
                    @endif
                    <div class="card-header">
                        <div class="card-title"><b>Title</b>
                            <h1>{{$post->title}}</h1></div>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><b>Excerpt</b>
                        <h3>{{$post->excerpt}}</h3></p>
                        <p class="card-text">{{$post->content}}</p>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Comments: {{$post->comments()->count()}}</p>
                        <a target="_parent" href="/" class="btn btn-dark">Back</a>
                    </div>
                    <div class="card-body">
                        <h5>Leave a comment</h5>
                        <form method="post" action="#">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="comment" class="form-control"/>
                                <input type="hidden" name="post_id" value="{{ $post->id }}"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-info"
                                       value="Add Comment"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(count($post->comments)>0)
                <div class="col-md-8">
                    <div class="card text-center my-2">
                        <div class="card-header">
                            <div class="card-title"><h2>Comments</h2></div>
                        </div>
                    </div>
                    @include('partials.comments', ['comments' => $post->comments, 'post_id' => $post->id])
                </div>
            @endif
        </div>
@endsection
