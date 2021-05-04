@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Actions') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('posts.create')}}" class="btn btn-outline-info">Create a new post</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card-columns">
                    <div class="card text-dark bg-light">
                        <div class="card-body">
                            <h2 class="card-title">Total Posts</h2>
                            <h6 class="card-subtitle mb-2 text-dark">Number of articles you've posted</h6>
                            <h2>{{auth()->user()->posts->count()}}</h2>
                            <p class="card-text">Each time you create a post, you earn
                                <strong class="text-danger">+10 points</strong>
                            </p>
                            <a href="{{route('posts.index')}}" class="btn btn-outline-dark">My Posts</a>
                        </div>
                    </div>
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-body">
                            <h2 class="card-title">Total Comments</h2>
                            <h6 class="card-subtitle mb-2">Number of your comments on blog posts</h6>
                            <h2>{{auth()->user()->comments->count()}}</h2>
                            <p class="card-text">Each time you leave a comment on an article you earn
                                <strong class="text-warning">+5 points</strong>
                            </p>
                            <a href="/" class="btn btn-outline-light">Leave a Comment!</a>
                        </div>
                    </div>
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">
                            <h2>Points!</h2>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Your total points</h6>
                            <p class="card-text"><strong>{{auth()->user()->points}}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
