<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->paginate(10);
        $categories = Category::all();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        $user = Auth::user();
        $current_tags = $post->tags->pluck('id')->toArray();
        return view('admin.posts.create', compact('post', 'categories', 'tags', 'current_tags', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:1|max:50|unique:posts',
            'content' => 'nullable|string',
            'image' => 'nullable|url',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',

        ],
        [
            'title.required' => 'This field cannot be left blank',
            'title.string' => 'The file format is invalid',
            'title.unique' => "$request->title alredy exists",
            'title.min' => "$request->title is too short",
            'title.max' => "$request->title is too long",

            'content.string' => 'The file format is invalid',

            'image.url' => 'The file format is invalid',

            'category_id.exists' => 'Selected category does not exists',
            'tags.exists' => 'Selected tag does not exists',
        ]);


        $data = $request->all();

        $post = new Post();

        $post->fill($data);
        
        $post->slug = Str::slug($data['title'], '-');

        $post->save();

        if(array_key_exists('tags', $data)){
            $post->tags()->attach($data['tags']);
        };

        return redirect()->route('admin.posts.index')->with('message', 'Post was successfully created')->with('type', 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = Category::all();
        $users = User::all();
        $tags = Tag::select('id', 'label')->get();
        return view('admin.posts.show', compact('post', 'categories', 'users', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::select('id', 'label')->get();
        $tags = Tag::select('id', 'label')->get();
        $current_tags = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'current_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:1', 'max:50', Rule::unique('posts')->ignore($post->id)],
            'content' => 'nullable|string',
            'image' => 'nullable|url',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
        ],
        [
            'title.required' => 'This field cannot be left blank',
            'title.string' => 'The file format is invalid',
            'title.unique' => "$request->title alredy exists",
            'title.min' => "$request->title is too short",
            'title.max' => "$request->title is too long",

            'content.string' => 'The file format is invalid',

            'image.url' => 'The file format is invalid',

            'category_id.exists' => 'Selected category does not exists',

            'tags.exists' => 'Selected tag does not exists',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->title, '-');

        if(array_key_exists('switch_author', $data)){
            $post->user_id = Auth::id();
        }

        $post->update($data);

        if(array_key_exists('tags', $data)){
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post)->with('message', 'Post was successfully edited')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(count($post->tags)){
            $post->tags->detach();
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('message', 'Post was successfully deleted')->with('type', 'success');
    }
}
