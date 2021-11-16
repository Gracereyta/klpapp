<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductSubcategory;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Helpers;
use Illuminate\Support\Facades\Storage;
use DB;

class ProductsController extends Controller
{

    public function index($category_id, $sub)
    {
        $store = Helpers::selected_store();
        $data = DB::table('products as p')
                ->join('product_subcategories as ps', 'ps.product_id', '=', 'p.id')
                ->where('ps.storeid', $store->id)
                ->where('ps.category_id', $category_id)
                ->where('ps.sub_category_id', $sub)
                ->get();
        
        $items_image = [];
        foreach ($data as $key => $value) {
            $value->images;
            $items_image = json_decode($value->images);
           
        }
        $productImg = DB::table('product_images')->get();

        return view('product.product-list', compact('data', 'sub', 'category_id', 'productImg', 'items_image'));
    }

    public function subCategory(Subcategory $subcategory, $id)
    {
        $subcategory = Subcategory::find($id);
        return response()->json($subcategory, 201);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $dev = Helpers::development();
        $store = Helpers::selected_store();
        $db = new Products;
        $db->name = $request->product_name;
        $db->price = $request->price;
        $db->details = $request->details;
        $db->howtouse = $request->howtouse ?? '';
        $db->video = $request->video ?? '';
        $db->images = "";
        $db->save();

        if ($db->save()) {
            $subCat = new ProductSubcategory;
            $subCat->storeid = $store->id;
            $subCat->product_id = $db->id;
            $subCat->category_id = $request->category_id;
            $subCat->sub_category_id = $request->sub_category_id;
            $subCat->save();

            foreach ($request->file('picture') as $key => $val) {
                $name = $val->getClientOriginalName();
                // $val->storeAs('public/images/products', $name);
                $val->storePubliclyAs('public/images/products',  $name, $dev);
                $storage_path = env('DO_URL').'/public/images/products/'.$name;

                $collection[] = collect([
                    'image' => $name,
                ]);
                $db = Products::find($db->id);
                $db->images = $collection;
                $db->update();
  
                $productImg = new ProductImages;
                $productImg->product_id = $db->id;
                $productImg->image_name = $storage_path;
                $productImg->save();
            }
            if ($request->file('videos')) {
                foreach ($request->file('videos') as $key => $val) {
                    $name = $val->getClientOriginalName();
                    // $val->storeAs('public/images/products', $name);
                    // $val->storePubliclyAs('public/images/products',  $name, $dev);
                    $storage_path = env('DO_URL').'/public/images/products/'.$name;
                    Storage::disk($dev)->putFileAs('public/images/products', $val, $name, 'public');
    
                    $collection1[] = collect([
                        'video' => $name,
                    ]);
                    $db = Products::find($db->id);
                    $db->video = $collection1;
                    $db->update();
                }
            }
            
            
        }
        
        return response('created', 201); 
    }

    public function show(Products $products)
    {
        //
    }

    public function edit(Products $products, $id)
    {
        $product = Products::find($id);
        return $product;
    }

    public function update(Request $request, Products $products)
    {   
        ini_set('memory_limit', '4096M'); 
        $dev = Helpers::development();
        if ($request->picture == "") {
            $db = Products::find($request->id);
            $db->name = $request->product_name;
            $db->price = $request->price;
            $db->details = $request->details;
            $db->howtouse = $request->howtouse ?? '';
            $db->update();

            if ($request->file('videos')) {
                foreach ($request->file('videos') as $key => $val) {
                    $name1 = $val->getClientOriginalName();
                    // $val->storeAs('public/images/products', $name);
                    // $val->storePubliclyAs('public/images/products',  $name1, $dev);
                    Storage::disk($dev)->putFileAs('public/images/products', $val, $name1, 'public');
    
                    $product = Products::find($request->id);
                    $images1 = json_decode($product->video);
                    $collection1 = collect(
                        $images1,
                    );
    
                    $pushToCol1 = $collection1->push(['video' => $name1]);
                    $product->video = $pushToCol1;
                    $product->update();
                }
            } 

        } else {
            foreach ($request->file('picture') as $key => $val) {
                $name = $val->getClientOriginalName();
                // $val->storeAs('public/images/products', $name);
                $val->storePubliclyAs('public/images/products',  $name, $dev);

                $product = Products::find($request->id);
                $images = json_decode($product->images);
                $collection = collect(
                    $images,
                );

                $pushToCol = $collection->push(['image' => $name]);
                $product->images = $pushToCol;
                $product->update();
            }
            if ($request->file('videos')) {
                foreach ($request->file('videos') as $key => $val) {
                    $name1 = $val->getClientOriginalName();
                    // $val->storeAs('public/images/products', $name);
                    // $val->storePubliclyAs('public/images/products',  $name1, $dev);
                    Storage::disk($dev)->putFileAs('public/images/products', $val, $name1, 'public');
    
                    $product = Products::find($request->id);
                    $images1 = json_decode($product->video);
                    $collection1 = collect(
                        $images1,
                    );
    
                    $pushToCol1 = $collection1->push(['video' => $name1]);
                    $product->video = $pushToCol1;
                    $product->update();
                }
            } 
            
    
            $db = Products::find($request->id);
            $db->name = $request->product_name;
            $db->price = $request->price;
            $db->details = $request->details;
            $db->howtouse = $request->howtouse ?? '';

            $db->update();
        }

        return response('update', 201);
    }

    public function destroy(Products $products, Request $request)
    {
        $subcategory = Products::where('id', $request->id)->delete();
        return response('deleted', 201);
    }

    public function removeImage(Request $request)
    {
        $products = Products::find($request->product_id);
        $data = $products->images;
        
        if ($request->index == 0) {
            $res = str_replace('{"image":"'.$request->image.'"},', '', $data);
        } else {
            $res = str_replace(',{"image":"'.$request->image.'"}', '', $data);
        }
    
        $products->images = $res;
        $products->save();
        return response('deleted', 201);
    }

    public function removeVideo(Request $request)
    {
        $products = Products::find($request->product_id);
        $data = $products->video;
        
        if ($request->index == 0) {
            $res = str_replace('{"video":"'.$request->image.'"},', '', $data);
        } else {
            $res = str_replace(',{"video":"'.$request->image.'"}', '', $data);
        }
    
        $products->video = $res;
        $products->save();
        return response('deleted', 201);
    }

    public function deleteVideo(Request $request)
    {
        $products = Products::find($request->product_id);
        $products->video = '';
        $products->save();
        return response('deleted', 201);
    }

    public function selectImages(Request $request) 
    {
        $image = DB::table('product_images')->where('product_id', $request->id)->get();
        return $image;
    }

}
