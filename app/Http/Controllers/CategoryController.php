<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Helpers;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $store = Helpers::selected_store();
        $categories = Category::where('storeid', $store->id)->get();
        return view('dashboard', compact('categories', 'store'));
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

        $db = new Category;
        $image = $request->file('picture');
        $extension = $image->getClientOriginalExtension(); // Get the extension
        $image_name = $request->filename;

        $storage_path1 = env('DO_URL').'/public/images/category/'.$request->filename;
        
        // $request->file('picture')->storeAs('public/images/category', $image_name);
        $request->file('picture')->storePubliclyAs('public/images/category',  $image_name, $dev);

        if ($request->file('picture2')) {
            $image2 = $request->file('picture2');
            $extension2 = $image2->getClientOriginalExtension(); // Get the extension
            $image_name2 = $request->filename2;
            $storage_path2 = env('DO_URL').'/public/images/category/'.$request->filename2;
            // $request->file('picture2')->storeAs('public/images/category', $image_name2);
            $request->file('picture')->storePubliclyAs('public/images/category',  $image_name2, $dev);

            $db->banner_image = $storage_path2;
        } else {
            $db->banner_image = "";
        }
        
        $db->name = $request->name;
        $db->description = $request->description;
        $db->image = $storage_path1;
        $db->storeid = $store->id;
        $db->save();
        
        return response('created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        $category = Category::find($id);
        return response()->json($category, 201);
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
        $dev = Helpers::development();
        if ($request->picture || $request->picture2) {
            $db = Category::find($request->id);

            if ($request->picture) {
                $image = $request->file('picture');
                $extension = $image->getClientOriginalExtension(); // Get the extension
                $image_name = $request->filename;

                // $request->file('picture')->storeAs('public/images/category', $image_name);
                $request->file('picture')->storePubliclyAs('public/images/category', $image_name, $dev);
                $storage_path1 = env('DO_URL').'/public/images/category/'.$request->filename;
                $db->image = $storage_path1;
            }

            if ($request->picture2) {
                $image2 = $request->file('picture2');
                $extension2 = $image2->getClientOriginalExtension(); // Get the extension
                $image_name2 = $request->filename2;

                // $request->file('picture2')->storeAs('public/images/category', $image_name2);
                $request->file('picture2')->storePubliclyAs('public/images/category', $image_name2, $dev);

                $storage_path2 = env('DO_URL').'/public/images/category/'.$request->filename2;
                $db->banner_image = $storage_path2;
            }
            
            $db->name = $request->name;
            $db->description = $request->description;
            $db->update();

        } else {
            $db = Category::find($request->id);
            $db->name = $request->name;
            $db->description = $request->description;

            $db->update();
        }
        
        return response('updated', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
        $db = Category::where('id', $request->id)->delete();
        return response('deleted', 201);
    }
    
}
