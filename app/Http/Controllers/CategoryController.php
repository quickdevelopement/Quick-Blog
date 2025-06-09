<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=> 'required']);

        if(Category::where('name', $request->name)->exists()){
            flash()->error('Category Already Exists!');
            return redirect()->back();
        }

        
        Category::create($request->all());

        flash()->success('Category Create Successfully');

        return redirect()->route('categories.show');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $categories = Category::latest()->get();
        return view('categories.index', ['categories'=>$categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $category = Category::findOrFail($id);
        return view( 'categories.edit', ['category'=>$category]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $category = Category::findOrFail($id);

        $request->validate(['name'=> 'required']);

        if(Category::where('name', $request->name)->exists()){
            flash()->error('Category Already Exists!');
            return redirect()->back();
        }

        

        $category->update($request->all());

        flash()->success('Category Updated Successfully');

        return redirect()->route('categories.show');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete( $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        flash()->success('Category Deleted Successfully');

        return redirect()->route('categories.show');
    }
}
