@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('admin.posts.store')}}" method="POST">
        @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                    <option value="">No category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->label}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" class="form-control" id="content" name="content">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="text" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection