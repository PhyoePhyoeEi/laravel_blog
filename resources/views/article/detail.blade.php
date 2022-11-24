
@extends ("layouts.app")
@section ("content")
<div class="container">
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <div class="card-subtitle mb-2 text-muted small">{{ $article->created_at->diffForHumans()  }}
                Category : <b>{{ $article->category->name }}</b>
            </div>
            <p class="card-text">{{ $article->body }}</p>
            @auth
                @can('article_delete', $article)
                    <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-secondary">Edit</a>
                    <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-warning">Detete</a>
                @endcan
            @endauth
        </div>
    </div>
      @if (@session("info"))
       <div class="alert alert-success">{{ @session("info") }}</div>
      @endif
      @foreach ($errors->all() as $error)
        <div class="alert alert-warning">{{ $error }}</div>
      @endforeach
    <ul class="list-group mb-2">
        <li class="list-group-item active">
            <b>Comment ({{ count($article->comments) }})</b>
        </li>
        @foreach ($article->comments as $comment)

            <li class="list-group-item">
                <div class="text-success">
                    {{ $comment->user->name }}
                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                </div>

                {{ $comment->content }}
                @auth
                    @can('comment_delete', $comment)
                        <a href="{{ url("/comment/delete/$comment->id") }}" class="btn-close float-end" ></a>
                    @endcan
                @endauth

            </li>
        @endforeach
    </ul>

    @auth
            <form action="{{ url('comment/add') }}" method="post">
            @csrf
            <input type="hidden" class="form-control" name="article_id" id="" value="{{ $article->id }}">
            <textarea name="content" class="form-control mb-2" placeholder="New Comment" id="" cols="10" rows="5"></textarea>
            <input type="submit" class="btn btn-secondary" value="Add Commment">
            </form>
    @endauth
</div>
@endsection
