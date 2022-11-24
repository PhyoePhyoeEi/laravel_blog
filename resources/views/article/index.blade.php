
@extends ("layouts.app")
@section ("content")
<div class="container">

    @if (@session("info"))
       <div class="alert alert-success">{{ @session("info") }}</div>
    @endif
    {{ $articles->links() }}

    @if(@session("error"))
        <div class="alert alert-warning">{{ @session("error") }}</div>
    @endif

    @foreach($articles as $article)
    <div class="card mb-2">
        <div class="card-body">
            <h5 class="card-title">{{ $article->title }}</h5>
            <small class="">{{ $article->created_at->diffForHumans() }} </small><br>
            <small class="text-primary">
                {{ $article->user->name }}

            Category : <b>{{ $article->category->name }}</b>
            {{-- Category: <b>{{ $article->category->name }}</b> --}}
            ({{ count($article->comments) }}) Comments
            </small>

        <p class="card-text">{{ $article->body }}</p>

        </div>
        <div class="card-footer mb-2">
            <a href="{{ url("/articles/detail/$article->id") }}" class="card-link">View Detail</a>
        </div>
    </div>
    @endforeach

</div>
@endsection
