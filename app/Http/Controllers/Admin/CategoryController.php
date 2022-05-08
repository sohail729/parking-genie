<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct(
        CategoryContract $categoryRepository) {
        $this->categoryRepository       =   $categoryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.category.modal.form')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if(isset($input['image'])){
            $catImage = $this->fileUpload($input['image'], 'categories');
            $input['image'] = $catImage;
        }
        $response = $this->categoryRepository->store($input);
        if($response){
            $request->session()->flash('alert-success', 'New Category Added Successfull!');
            return redirect()->route('admin.categories.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::pluck('title','id')->toArray();
        return  view('admin.category.modal.form', compact('category', 'categories'))->render();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $collect = collect($request->all())->filter();
        $input =  $collect->all();
        // $catImage = $this->fileUpload($input['image'], 'categories');
        // $input['image'] = $catImage;
        $response = $this->categoryRepository->update($input, $category);
        if($response){
            $request->session()->flash('alert-success', 'Category Updated Successfull!');
            return redirect()->route('admin.categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $response = $this->categoryRepository->delete($category);
        if($response){
            return true;
        }
        return false;
    }
}
