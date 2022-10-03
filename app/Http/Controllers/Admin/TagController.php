<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = new Tag();
        $colors = config('colors');
        return view('admin.tags.create', compact('colors', 'tag'));

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
            'label' => 'required|string|unique:categories',
        ],
        [
            'required' => 'This field cannot be left blank',
            'string' => 'The file format is invalid',
            'label.unique' => "$request->label alredy exists",

        ]);

        $data = $request->all();

        $tag = new Tag();

        $tag->fill($data);
        
        $tag->save();

        return redirect()->route('admin.tags.index')->with('message', 'Tag was successfully created')->with('type', 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $colors = config('colors');
        return view('admin.tags.edit', compact('tag', 'colors'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', Rule::unique('tags')->ignore($tag->id)],
        ],
        [
            'required' => 'This field cannot be left blank',
            'string' => 'The file format is invalid',
            'label.unique' => "$request->label alredy exists",

        ]);

        $data = $request->all();

        $tag->update($data);

        return redirect()->route('admin.tags.show', $tag)->with('message', 'Tag was successfully edited')->with('type', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('message', 'Tag was successfully deleted')->with('type', 'success');

    }
}
