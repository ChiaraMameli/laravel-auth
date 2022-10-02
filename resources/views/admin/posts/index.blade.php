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
        <th scope="col">Author</th>
        <th scope="col">Category</th>
        <th scope="col">Tags</th>
        <th scope="col">Content</th>
        <th scope="col">Last update</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                
                @if($post->user)
                <th scope="row">{{$post->user->name}}</th>
                @else
                    <td>No author found</td>
                @endif

                @if($post->category)
                    <td><span class="badge badge-pill badge-{{$post->category->color ?? 'info'}}" style="width: 4rem">{{$post->category->label}}</span></td>
                @else
                    <td>No category found</td>
                @endif

                @forelse($post->tags as $tag)
                    <td class="d-flex flex-column">
                        <span class="badge badge-{{$tag->color_tag}}" style="width: 4rem">{{$tag->label}}</span>
                    </td>
                @empty
                    <td>No tag found</td>
                @endforelse
                    
                <td>{{$post->content}}</td>
                <td>{{$post->updated_at}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('admin.posts.show', $post)}}" class="btn btn-primary btn-sm ml-1"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{route('admin.posts.edit', $post)}}" class="btn btn-warning btn-sm ml-1"><i class="fa-solid fa-pencil"></i></a>
                        <form action="{{route('admin.posts.destroy', $post)}}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No posts found</td>
            </tr>
        @endforelse
    </tbody>
    </table>
    <div>
        @if($posts->hasPages())
            {{$posts->links()}}
        @endif
    </div>
</div>
@endsection