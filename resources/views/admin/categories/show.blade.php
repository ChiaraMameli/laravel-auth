@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
<div class="card" style="width: 22rem;">
  <div class="bg-{{$category->color}}" style="height: 12rem"></div>
  <div class="card-body">
    <h5 class="card-title">{{$category->label}}</h5>
    <div class="d-flex justify-content-between">
        <a href="{{route('admin.categories.index', $category)}}" class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i> Go Back</a>
        <div class="d-flex">
            <a href="{{route('admin.categories.edit', $category)}}" class="btn btn-warning"><i class="fa-solid fa-pencil"></i> Edit</a>
            <form action="{{route('admin.categories.destroy', $category)}}" method="POST" class="delete-form">
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