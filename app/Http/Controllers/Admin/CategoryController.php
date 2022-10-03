<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $colors = config('colors');
        return view('admin.categories.create', compact('colors', 'category'));
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
            'color' => 'required|string',


        ],
        [
            'label.required' => 'This field cannot be left blank',
            'label.string' => 'The file format is invalid',
            'label.unique' => "$request->label alredy exists",

            'color.required' => 'This field cannot be left blank',
        ]);


        $data = $request->all();

        $category = new Category();

        $category->fill($data);
        
        $category->save();

        return redirect()->route('admin.categories.index')->with('message', 'Category was successfully created')->with('type', 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        return view('admin.categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $colors = config('colors');
        return view('admin.categories.edit', compact('category', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', Rule::unique('categories')->ignore($category->id)],
            'color' => 'required|string',
        ],
        [
            'label.required' => 'This field cannot be left blank',
            'label.string' => 'The file format is invalid',
            'label.unique' => "$request->label alredy exists",

            'color.required' => 'This field cannot be left blank',
        ]);

        $data = $request->all();

        $category->update($data);

        return redirect()->route('admin.categories.show', $category)->with('message', 'Category was successfully edited')->with('type', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', 'Category was successfully deleted')->with('type', 'success');
    }
}
