<div class="container">

@if($post->exists)
    <form action="{{route('admin.posts.update', $post)}}" method="POST">
    @method('PUT')
@else
    <form action="{{route('admin.posts.store')}}" method="POST">
@endif

    @csrf
    <div class="row">
        <div class="col-8 form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
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
            <textarea class="form-control" id="content" name="content" rows="5">{{old('content', $post->content)}}</textarea>
        </div>
        <div class="col-10 form-group">
            <label for="image-field">Image</label>
            <input type="text" class="form-control" id="image-field" name="image" value="{{old('image', $post->image)}}">
        </div>
        <div class="col-2 form-group">
            <img id="image-preview" class="img-fluid rounded" src="https://troianiortodonzia.it/wp-content/uploads/2016/10/orionthemes-placeholder-image.png" alt="placeholder">
        </div>
        <button type="submit" class="btn btn-primary ml-3">{{$post->exists ? 'Edit' : 'Save'}}</button>
    </div>
    </form>
</div>
