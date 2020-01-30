<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Item;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //store all categories in variable
        $categories = Category::all();

        //get items
        $items = Item::pluck('id');

        //return view
        return view('categories.index', compact('items'))->withCategories($categories);
        
        // return view('categories.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request, array(
            'category' => 'required|max:255|unique:categories,category'
        ));

        ///store in db
        $category = new Category;
        $category->category = $request->category;
        $category->save();

        Session::flash('success', 'Category created successfully!');
        //redirect
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //put category in variable
        $category = Category::find($id);

        //return view
        return view('categories.edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate
        $this->validate($request, array(
            'category' => 'required|max:255|unique:categories,category'
        ));

        //save to db
        $category = Category::find($id);
        $category->category = $request->input('category');
        $category->save();

        Session::flash('success', 'Category updated successfully!');
        //redirect
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get items
        $item = Item::pluck('category');

        // $item = Item::find($id);

        // echo "$item $id";
        for ($i=0; $i<strlen($item); $i++) {
            //echo "$item $id";
            if (!$item[$i] == $id) {
                $categories = Category::find($id);
                $categories->delete();

                Session::flash('success', 'Record deleted successfully');
                break;
            } else {
                Session::flash('success', 'Failed Category being used.');
                break;
            }
        }

        //redirect
        return redirect()->route('categories.index');
    }
}
