@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2>My Tags</h2>
        <a class="btn btn-success" href="{{ route('admin.tags.create') }}"><i class="fa-solid fa-plus"></i> Create new tag</a>
    </div>


    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Label</th>
        <th scope="col">Color</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tags as $tag)
            <tr>
                <th scope="row">{{$tag->id}}</th>
                <td>{{$tag->label}}</td>
                <td>{{$tag->color_tag}}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{route('admin.tags.show', $tag)}}" class="btn btn-primary btn-sm ml-1"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{route('admin.tags.edit', $tag)}}" class="btn btn-warning btn-sm ml-1"><i class="fa-solid fa-pencil"></i></a>
                        <form action="{{route('admin.tags.destroy', $tag)}}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No tags found</td>
            </tr>
        @endforelse
    </tbody>
    </table>
</div>
@endsection