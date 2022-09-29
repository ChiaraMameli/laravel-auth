@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2>My Posts</h2>
        <a class="btn btn-success" href="{{ route('admin.posts.create') }}"><i class="fa-solid fa-plus"></i> Create new post</a>
    </div>


    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">Image</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                <td><img src="{{$post->image}}" alt="{{$post->title}}" class="img-fluid"></td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('admin.posts.show', $post)}}" class="btn btn-primary btn-sm ml-1"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{route('admin.posts.edit', $post)}}" class="btn btn-warning btn-sm ml-1"><i class="fa-solid fa-pencil"></i></a>
                        <form action="{{route('admin.posts.destroy', $post)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td>No post found</td>
            </tr>
        @endforelse
    </tbody>
    </table>
</div>
@endsection