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
                    <option @if(old('category_id', $post->category_id) == $category->id) selected @endif value="{{$category->id}}">{{$category->label}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12">
            <h5>Tags</h5>
                @if(count($tags))
                    @foreach($tags as $tag)
                    <div class="form-check form-check-inline mb-3">
                        <input class="form-check-input" type="checkbox" id="tag-{{$tag->label}}" name="tags[]" value="{{$tag->id}}" @if(in_array($tag->id, old('tags', $current_tags))) checked @endif>
                        <label class="form-check-label" for="tag-{{$tag->label}}">
                            {{$tag->label}}
                        </label>
                    </div>
                    @endforeach
                @endif
                
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

        @if($post->exists && $post->user_id !== Auth::id())
            <div class="col-12">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="switch_author" name="switch_author" @if(old('switch_author')) checked @endif>
                    <label class="form-check-label" for="switch_author">
                        Sign me as author <br/> <strong>Previous author:</strong> {{$post->user->name}}
                    </label>
                </div>
            </div>
        @endif

        <a href="{{route('admin.posts.index', $post)}}" class="btn btn-secondary ml-3"><i class="fa-solid fa-rotate-left"></i> Go Back</a>
        <div class="col-10"></div>
        <button type="submit" class="btn btn-primary align-self-end">{{$post->exists ? 'Edit' : 'Save'}}</button>
    </div>
    </form>
</div>
