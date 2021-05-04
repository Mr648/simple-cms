@foreach($comments as $comment)
    <div class="card my-2">
        <div class="card-header">
            <div class="card-title">
                <strong>{{ $comment->user->name }}</strong>
            </div>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p>{{ $comment->comment }}</p>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="/">
                @csrf
                <div class="form-group">
                    <input type="text" name="comment" class="form-control"/>
                    <input type="hidden" name="post_id" value="{{ $post_id }}"/>
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-outline-success"
                           value="Reply"/>
                </div>
            </form>
        </div>
        @include('partials.comments', ['comments' => $comment->replies])
    </div>
@endforeach
