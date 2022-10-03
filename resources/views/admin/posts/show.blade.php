@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
        @if($post->image)
            <img src="{{$post->image}}" alt="{{$post->title}}" class="img-fluid">
        @else
            <img src="https://troianiortodonzia.it/wp-content/uploads/2016/10/orionthemes-placeholder-image.png" class="img-fluid" alt="placeholder">
        @endif
        </div>
        <div class="col-md-8 d-flex flex-column justify-content-between">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->content}}</p>

                @if($post->category)
                <p class="card-text"><strong>Category: </strong>{{$post->category->label}}</p>
                @endif

                <p class="card-text"><strong>Author: </strong>{{$post->user->name ?? 'Unknown'}}</p>
                <p class="card-text"><strong>Last update: </strong><time>{{$post->updated_at}}</time></p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{route('admin.posts.index', $post)}}" class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i> Go Back</a>
                <div class="d-flex">
                    <a href="{{route('admin.posts.edit', $post)}}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i> Edit</a>
                    <form action="{{route('admin.posts.destroy', $post)}}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ml-1"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection