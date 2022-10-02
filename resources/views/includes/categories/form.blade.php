<div class="container">

@if($category->exists)
    <form action="{{route('admin.categories.update', $category)}}" method="POST" novalidate>
    @method('PUT')
@else
    <form action="{{route('admin.categories.store')}}" method="POST" novalidate>
@endif

    @csrf
    <div class="row">
        <div class="col-8 form-group">
            <label for="label">Label</label>
            <input type="text" class="form-control @error('label') is-invalid @enderror" id="label" name="label" value="{{old('label', $category->label)}}">
            @error('label')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-4 form-group">
            <label for="color">Color</label>
            <select class="form-control" id="color" name="color">
                <option value="">No category</option>
                @foreach($colors as $color)
                    <option @if(old('color', $category->color) == $color['value']) selected @endif value="{{$color['value']}}">{{$color['label']}}</option>
                @endforeach
            </select>
        </div>

        <a href="{{route('admin.categories.index', $category)}}" class="btn btn-secondary ml-3"><i class="fa-solid fa-rotate-left"></i> Go Back</a>
        <div class="col-10"></div>
        <button type="submit" class="btn btn-primary align-self-end">{{$category->exists ? 'Edit' : 'Save'}}</button>
    </div>
    </form>
</div>
