<ul class="navbar-nav mr-auto">
    <li><a class="nav-link @if(Route::is('admin.posts.index')) active @endif" href="{{ route('admin.posts.index') }}">Posts</a></li>
    <li><a class="nav-link @if(Route::is('admin.categories.index')) active @endif" href="{{ route('admin.categories.index') }}">Categories</a></li>
    <li><a class="nav-link @if(Route::is('admin.tags.index')) active @endif" href="{{ route('admin.tags.index') }}">Tags</a></li>
</ul>
