@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-4">
        <img src="{{$post->image}}" alt="{{$post->title}}" class="img-fluid">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->content}}</p>
                <p class="card-text"><small class="text-muted">pippo</small></p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{route('admin.posts.index', $post)}}" class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i> Go Back</a>
                <div class="d-flex">
                    <a href="{{route('admin.posts.edit', $post)}}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i></a>
                    <form action="{{route('admin.posts.destroy', $post)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ml-1"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection