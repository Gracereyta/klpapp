<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Helpers;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $store = Helpers::selected_store();
        $category_id = $id;
        $subcategories = Subcategory::where('category_id', $id)->where('storeid', $store->id)->get();
        return view('category.makeup', compact('subcategories', 'category_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = Helpers::selected_store();
        $dev = Helpers::development();

        $image = $request->file('picture');
        $extension = $image->getClientOriginalExtension(); // Get the extension
        $image_name = $request->filename;

        // $request->file('picture')->storeAs('public/images/subcategory', $image_name);
        $request->file('picture')->storePubliclyAs('public/images/subcategory',  $image_name, $dev);

        $storage_path = env('DO_URL').'/public/images/subcategory/'.$request->filename;

        $db = new Subcategory;
        $db->subcategory_name = $request->name;
        $db->details = $request->description;
        $db->image = $storage_path;
        $db->category_id = $request->category_id;
        $db->storeid = $store->id;
        $db->save();
        
        return response('created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory, $id)
    {
        $subcategory = Subcategory::find($id);
        return response()->json($subcategory, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        if ($request->picture == "") {
            $db = Subcategory::find($request->id);
            $db->subcategory_name = $request->name;
            $db->details = $request->description;

            $db->update();

        } else {
            $dev = Helpers::development();
            $image = $request->file('picture');
            $extension = $image->getClientOriginalExtension(); // Get the extension
            $image_name = $request->filename;

            // $request->file('picture')->storeAs('public/images/subcategory', $image_name);
            $request->file('picture')->storePubliclyAs('public/images/subcategory',  $image_name, $dev);

            $storage_path = env('DO_URL').'/public/images/subcategory/'.$request->filename;

            $db = Subcategory::find($request->id);
            $db->subcategory_name = $request->name;
            $db->image = $storage_path;
            $db->details = $request->description;

            $db->update();
        }

        return response('updated', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory, Request $request)
    {
        $subcategory = Subcategory::where('id', $request->id)->delete();
        return response('deleted', 201);
    }

    public function categoryDetails(Request $request, $id)
    {
        $category = Category::find($id);
        return $category;
    }   

}
