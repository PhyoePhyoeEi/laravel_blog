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
            <input type="text" name="title" id="" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Body</label>
            <input type="text" name="body" id="" class="form-control">
        </div>
        <div class="mb-3">
            <label for="">Category</label>
            <select name="category_id" id="" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <input type="submit" value="Add Article" class="btn btn-primary">
    </form>
</div>
@endsection
