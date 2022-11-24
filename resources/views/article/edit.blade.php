@extends('layouts.app')
@section('content')
<div class="container">
    @if($errors->any())
        <div class="alert alert-warning">
           @foreach ($errors->all() as $error)
               {{ $error }}
           @endforeach
        </div>
    @endif

    <form action="" method="post">
        @csrf
        <div class="mb-3">
            <label for="">Title</label>
            <input type="text" name="title" id="" value="{{ $article->title }}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Body</label>
            <textarea name="body" id="" class="form-control" cols="10" rows="5">{{ $article->body }}</textarea>

        </div>
        <div class="mb-3">
            <label for="">Category</label>
            <select name="category_id" id="" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}"
                    @if ($article->category_id == $category->id)
                        selected
                    @endif
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <input type="submit" value="Update" class="btn btn-primary">
    </form>
</div>
@endsection
