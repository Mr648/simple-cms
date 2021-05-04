@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success">
                        <b>{{ session('success.message') }}</b>
                        <a href="{{session('success.link')}}" class="alert-link">Show</a>
                    </div>
                @endif

                <form method="post" action="{{route('posts.update' ,$post->slug)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" required id="title"
                               name="title"
                               placeholder="Title" value="{{ $post->title }}">
                        @error('title')
                        <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control @error('slug')is-invalid @enderror" required id="slug"
                               name="slug"
                               placeholder="slug" value="{{ $post->slug }}">
                        @error('slug')
                        <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Excerpt</label>
                        <input type="text" class="form-control @error('excerpt')is-invalid @enderror" required
                               id="excerpt" name="excerpt"
                               placeholder="excerpt" value="{{ $post->excerpt }}">
                        @error('excerpt')
                        <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content @error('content')is-invalid @enderror" required
                                  rows="5" name="content"
                                  placeholder="Content...">{{ $post->content }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        @if(!is_null($post->image))
                            <img class="img-thumbnail my-auto d-block" style="max-width: 20rem;"
                                 src="{{asset($post->image)}}"
                                 alt="{{$post->title}}">
                            <div class="badge badge-danger">If you choose another image, current image will be deleted.</div>
                        @endif
                        <br>
                        <label for="image">Post Image</label>
                        <input type="file" class="form-control-file @error('image')is-invalid @enderror" id="image"
                               name="image">
                        @error('image')
                        <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-info">Update!</button>
            </div>
        </div>
    </div>
@endsection
