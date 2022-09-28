@extends('layouts.app')

@section('content')
<div class="container">
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
                <td><img src="{{$post->image}}" alt="{{$post->title}}"></td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{route('admin.posts.show', $post)}}" class="btn btn-secondary">Vedi</a>
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