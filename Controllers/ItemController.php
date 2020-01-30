<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Category;
use Image;
use Storage;
use Session;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //store all items in variable
       $items = Item::all();

       //return view
       return view('items.index')->withItems($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get categories
        $categories = Category::pluck('category', 'id');

        return view('items.create', compact('categories'));
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
            'category_id' => 'required|integer|min:1',
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|max:99999999.99',
            'quantity' => 'required|numeric|max:999999999',
            'sku' => 'required|max:255',
            'picture' => 'required'
        ));

        //store in db
        $item = new Item;

        //get category from dropdown
        // $catID = $request->category_id;
        // $category = Category::all();
        // $cat = $category[$catID-1]->category;
        // $item->category = $cat;
        
        $item->category = $request->category_id;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->sku = $request->sku;
        
        //save image
        $image = $request->file('picture');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/' . $filename);
        //save into location & filename into db
        Image::make($image)->resize(800,400)->save($location);
        $item->picture = $filename;

        $item->save();

        Session::flash('success', 'Item created successfully!');
        //redirect
        return redirect()->route('items.index');
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
        //put item in variable
        $item = Item::find($id);

        //get categories
        $categories = Category::pluck('category', 'id');

        //return view
        return view('items.edit', compact('categories'))->withItem($item);
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
            'category_id' => 'required|integer|min:1',
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|numeric|max:99999999.99',
            'quantity' => 'required|numeric|max:999999999',
            'sku' => 'required|max:255'
        ));

        //save to db
        $item = Item::find($id);

        //get category from dropdown
        // $catID = $request->input('category_id');
        // $category = Category::all();
        // $cat = $category[$catID-1]->category;
        // $item->category = $cat;
        
        $item->category = $request->input('category_id');
        $item->title = $request->input('title');
        $item->description = $request->input('description');
        $item->price = $request->input('price');
        $item->quantity = $request->input('quantity');
        $item->sku = $request->input('sku');

        if ($request->picture) {
            //save image
            $image = $request->file('picture');
            
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            //save into location & filename into db
            Image::make($image)->resize(800,400)->save($location);
            $oldFilename = $item->picture;
            $item->picture = $filename;
            //delete old image
            Storage::delete($oldFilename);
        }

        $item->save();

        Session::flash('success', 'Item updated successfully!');
        //redirect
        return redirect()->route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        //delete image
        $filename = $item->picture;
        Storage::delete($filename);

        Session::flash('success', 'Record deleted successfully');
        //redirect
        return redirect()->route('items.index');
    }
}
