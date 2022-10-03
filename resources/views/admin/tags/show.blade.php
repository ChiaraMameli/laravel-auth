@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
<div class="card" style="width: 22rem;">
  <div class="bg-{{$tag->color_tag}}" style="height: 12rem"></div>
  <div class="card-body">
    <h5 class="card-title">{{$tag->label}}</h5>
    <div class="d-flex justify-content-between">
        <a href="{{route('admin.tags.index', $tag)}}" class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i> Go Back</a>
        <div class="d-flex">
            <a href="{{route('admin.tags.edit', $tag)}}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i> Edit</a>
            <form action="{{route('admin.tags.destroy', $tag)}}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger ml-1"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
  </div>
</div>
</div>
@endsection