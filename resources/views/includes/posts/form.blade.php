<div class="container">

@if($post->exists)
    <form action="{{route('admin.posts.update', $post)}}" method="POST" novalidate>
    @method('PUT')
@else
    <form action="{{route('admin.posts.store')}}" method="POST" novalidate>
@endif

    @csrf
    <div class="row">
        <div class="col-8 form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title', $post->title)}}">
            @error('title')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-4 form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">No category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->label}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 form-group">
            <label for="content">Content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5">{{old('content', $post->content)}}</textarea>
            @error('content')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror

        </div>
        <div class="col-10 form-group">
            <label for="image-field">Image</label>
            <input type="text" class="form-control @error('image') is-invalid @enderror" id="image-field" name="image" value="{{old('image', $post->image)}}">
            @error('image')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror

        </div>
        <div class="col-2 form-group">
            <img id="image-preview" class="img-fluid rounded" src="https://troianiortodonzia.it/wp-content/uploads/2016/10/orionthemes-placeholder-image.png" alt="placeholder">
        </div>

        <a href="{{route('admin.posts.index', $post)}}" class="btn btn-secondary ml-3"><i class="fa-solid fa-rotate-left"></i> Go Back</a>
        <div class="col-10"></div>
        <button type="submit" class="btn btn-primary align-self-end">{{$post->exists ? 'Edit' : 'Save'}}</button>
    </div>
    </form>
</div>
