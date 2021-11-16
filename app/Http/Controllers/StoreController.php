<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Helpers;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        return view('stores', compact('stores'));
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
        if ($request->file('picture')) {
            $image = $request->file('picture');
            $imgname = $image->getClientOriginalName();
            $request->file('picture')->storeAs('public/images/category', $imgname);
        }
       
        $db = new Store;
        $db->name = $request->storename;
        $db->location = $request->location;
        $db->description = $request->details ?? '';
        $db->selected = $request->selected ?? '';
        $db->image = $imgname ?? '';
        $db->save();

        return response('created', 201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store, $storeid)
    {
        $store = Store::find($storeid);
        return $store;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        if ($request->file('picture')) {
            $image = $request->file('picture');
            $imgname = $image->getClientOriginalName();
            $request->file('picture')->storeAs('public/images/category', $imgname);
    
            $db = Store::find($request->storeid);
            $db->name = $request->storename;
            $db->location = $request->location;
            $db->description = $request->details ?? '';
            $db->selected = $request->selected ?? '';
            $db->image = $imgname ?? '';
            $db->update();
        } else {
            $db = Store::find($request->storeid);
            $db->name = $request->storename;
            $db->location = $request->location;
            $db->description = $request->details ?? '';
            $db->selected = $request->selected ?? '';
            $db->update();
        }

        return response('updated', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }

    public function selectStore($storeid)
    {
        $storeselected = Store::where('selected', 1)->get();

        if ($storeselected->isEmpty()) {
            $db = Store::find($storeid);
            $db->selected = true;
            $db->update();
        } else {
            $db = Store::find($storeselected[0]['id']);
            $db->selected = false;
            $db->update();

            if ($db->update()) {
                $db1 = Store::find($storeid);
                $db1->selected = true;
                $db1->update();
            }
        }
        return response('updated', 201);
    }
}
