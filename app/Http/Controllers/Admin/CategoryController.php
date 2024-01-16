<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (!empty($request->query('search'))) {
            $search = $request->query('search');
            $categories = Category::where('name', 'like', $search . '%')->get();

        } else {
            $categories = Category::all();
        }
        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $form_data = $request->validated();
        $slug = Category::getSlug($form_data['name']);
        $form_data['slug'] = $slug;
        $newCategory = Category::create($form_data);

        return to_route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('admin.categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $form_data = $request->validated();
        if ($category->name !== $form_data['name']) {
            $slug = Category::getSlug($form_data['name']);
            $form_data['slug'] = $slug;
        }
        $category->update($form_data);
        return redirect()->route('admin.categories.show', $category->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', "The category '$category->name' has been deleted");
    }
}
