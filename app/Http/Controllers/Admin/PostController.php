<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();

        return view('admin.posts.index', compact('posts'));
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
        return view('admin.posts.create', compact('post', 'categories'));
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
        ],
        [
            'title.required' => 'This field cannot be left blank',
            'title.string' => 'The file format is invalid',
            'title.unique' => "$request->title alredy exists",
            'title.min' => "$request->title is too short",
            'title.max' => "$request->title is too long",

            'content.string' => 'The file format is invalid',

            'image.url' => 'The file format is invalid'
        ]);


        $data = $request->all();

        $post = new Post();

        $post->fill($data);
        
        $post->slug = Str::slug($data['title'], '-');

        $post->save();

        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
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
        ],
        [
            'title.required' => 'This field cannot be left blank',
            'title.string' => 'The file format is invalid',
            'title.unique' => "$request->title alredy exists",
            'title.min' => "$request->title is too short",
            'title.max' => "$request->title is too long",

            'content.string' => 'The file format is invalid',

            'image.url' => 'The file format is invalid'
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->title, '-');

        $post->update($data);

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
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', 'Post was successfully deleted')->with('type', 'success');
    }
}
