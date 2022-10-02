@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2>My Categories</h2>
        <a class="btn btn-success" href="{{ route('admin.categories.create') }}"><i class="fa-solid fa-plus"></i> Create new category</a>
    </div>


    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Label</th>
        <th scope="col">Color</th>
        <th scope="col">Posts</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->label}}</td>
                <td>{{$category->color}}</td>
                <td>{{count($category->posts)}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('admin.categories.show', $category)}}" class="btn btn-primary btn-sm ml-1"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{route('admin.categories.edit', $category)}}" class="btn btn-warning btn-sm ml-1"><i class="fa-solid fa-pencil"></i></a>
                        <form action="{{route('admin.categories.destroy', $category)}}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No categories found</td>
            </tr>
        @endforelse
    </tbody>
    </table>
</div>
@endsection