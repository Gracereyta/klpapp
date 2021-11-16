<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductSubcategory;
use App\Models\Products;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use App\Models\Themes;
use DB;

class MakatiCircuitController extends Controller
{
    public $api = 6;

    public function categories()
    {
        // $categories = Category::when($this->ftv, function($query) {
        //     return $query->where('storeid', $this->ftv);
        // })->get();
        $categories = Category::where('storeid', $this->api)->get();
        return response()->json($categories, 201);
    }

    public function subCategories($category_id)
    {
        $query = DB::table('subcategories as s')
                ->join('categories as c', 'c.id', '=', 's.category_id')
                // ->when($category_id, function($query) use($category_id) {
                //     return $query->where('category_id', $category_id);
                // })
                ->where('s.category_id', $category_id)
                ->where('s.storeid', $this->api)
                ->select('s.image', 's.subcategory_name', 'c.name as category_name', 's.id', 'c.id as category_id', 'c.banner_image', 'c.image as category_image', 'c.description')
                ->get();
        return $query;
    }

    public function category($category_id)
    {
        $category = Category::find($category_id);
        return $category;
    }

    public function products($category_id, $sub_categoryid)
    {
        $data = DB::table('products as p')
        ->join('product_subcategories as ps', 'ps.product_id', '=', 'p.id')
        ->join('subcategories as s', 's.id', '=', 'ps.sub_category_id')
        ->join('categories as c', 'c.id', '=', 'ps.category_id')
        ->where('ps.category_id', $category_id)
        ->where('ps.sub_category_id', $sub_categoryid)
        ->where('ps.storeid', $this->api)
        ->select('c.name as category_name', 'p.name', 'p.price', 's.subcategory_name', 'p.images', 'ps.sub_category_id', 'ps.category_id', 'ps.product_id')
        ->get();
        return $data;
    }

    public function oneProduct($product_id)
    {   
        $product = Products::with('subcategory')->find($product_id);
        return $product;
    }

    public function subCategory($sub_categoryid)
    {
        $subcategory = Subcategory::find($sub_categoryid);;
        return $subcategory;
    }

    public function productImages($product_id)
    {   
        $images = ProductImages::where('product_id', $product_id)->get();
        return $images;
    }

    public function themes()
    {
        $categories = Themes::where('used_themes', 1)
                    ->where('storeid', $this->api)
                    ->get();
        return response()->json($categories, 201);
    }

    public function allSubCategories()
    {
        $query = DB::table('subcategories as s')
                ->join('categories as c', 'c.id', '=', 's.category_id')
                ->when($this->api, function($query) {
                    return $query->where('s.storeid', $this->api);
                })
                ->select('s.image', 's.subcategory_name', 'c.name as category_name', 's.id', 'c.id as category_id', 'c.banner_image', 'c.image as category_image', 'c.description')
                ->get();
        return $query;
    }

    public function allProducts()
    {
        $data = DB::table('products as p')
        ->join('product_subcategories as ps', 'ps.product_id', '=', 'p.id')
        ->join('subcategories as s', 's.id', '=', 'ps.sub_category_id')
        ->join('categories as c', 'c.id', '=', 'ps.category_id')
        ->when($this->api, function($query) {
            return $query->where('ps.storeid', $this->api);
        })
        ->select('c.name as category_name', 'p.name', 'p.price', 's.subcategory_name', 'p.images', 'ps.sub_category_id', 'ps.category_id', 'ps.product_id', 'p.video')
        ->get();
        return $data;
    }

    public function oneProductNew()
    {   
        $product = Products::with('subcategory')->get();
        return $product;
    }
}
