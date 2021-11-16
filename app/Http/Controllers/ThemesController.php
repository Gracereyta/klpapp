<?php

namespace App\Http\Controllers;

use App\Models\Themes;
use Illuminate\Http\Request;
use App\Http\Helpers;

class ThemesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Helpers::selected_store();
        $themes = Themes::where('storeid', $store->id)->get();
        return view('theme', compact('themes'));
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
        $db = new Themes;

        if ($request->file('pictureStore')) {
            $pictureStore = $request->file('pictureStore');
            $filenameStore = $request->filenameStore;
            $storage_path = env('DO_URL').'/public/images/themes/'.$filenameStore;
            // $request->file('pictureStore')->storeAs('public/images/themes', $filenameStore);
            $request->file('pictureStore')->storePubliclyAs('public/images/themes',  $filenameStore, $dev);

            $db->logo = $storage_path;
        } else {
            $db->logo = "default.jpg";
        }
        
        if ($request->file('pictureBanner')) {
            $pictureStore = $request->file('pictureBanner');
            $filenameBanner = $request->filenameBanner;
            $storage_path = env('DO_URL').'/public/images/themes/'.$filenameBanner;
            // $request->file('pictureBanner')->storeAs('public/images/themes', $filenameBanner)
            $request->file('pictureBanner')->storePubliclyAs('public/images/themes',  $filenameBanner, $dev);

            $db->banner = $storage_path;
        } else {
            $db->banner = "default.jpg";
        }
        
        if ($request->file('pictureIcon')) {
            $pictureStore = $request->file('pictureIcon');
            $filenameIcon = $request->filenameIcon;
            $storage_path = env('DO_URL').'/public/images/themes/'.$filenameIcon;
            // $request->file('pictureIcon')->storeAs('public/images/themes', $filenameIcon);
            $request->file('pictureIcon')->storePubliclyAs('public/images/themes',  $filenameIcon, $dev);

            $db->banner_icon = $storage_path;
        } else {
            $db->banner_icon = "default.jpg";
        }
        
        if ($request->file('pictureBG')) {
            $pictureStore = $request->file('pictureBG');
            $filenameBG = $request->filenameBG;
            $storage_path = env('DO_URL').'/public/images/themes/'.$filenameBG;
            // $request->file('pictureBG')->storeAs('public/images/themes', $filenameBG);
            $request->file('pictureBG')->storePubliclyAs('public/images/themes',  $filenameBG, $dev);

            $db->background = $storage_path;
        } else {
            $db->background = "default.jpg";
        }
        
        
        $db->used_themes = 0;
        $db->storeid = $store->id;
        $db->menu_text = $request->menuDetail;
        $db->save();
        
        return response('created', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function show(Themes $themes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function edit(Themes $themes, $id)
    {
        $themes = Themes::find($id);
        return $themes;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Themes $themes)
    {
        $dev = Helpers::development();
        $db = Themes::find($request->id);
        $db->storeid = $request->storeid;
        $db->menu_text = $request->menuDetail;
        
        if ($request->filenameStore) {
            $filenameStore = $request->filenameStore;
            $storage_path = env('DO_URL').'/public/images/themes/'.$filenameStore;
            $db->logo = $storage_path;
            
            // $request->file('pictureStore')->storeAs('public/images/themes', $filenameStore);
            $request->file('pictureStore')->storePubliclyAs('public/images/themes',  $filenameStore, $dev);
        } else {

        }
         
        if ($request->filenameBanner) {
            $filenameBanner = $request->filenameBanner;
            $storage_path = env('DO_URL').'/public/images/themes/'.$filenameBanner;
            $db->banner = $storage_path;
            // $request->file('pictureBanner')->storeAs('public/images/themes', $filenameBanner);
            $request->file('pictureBanner')->storePubliclyAs('public/images/themes',  $filenameBanner, $dev);
        } else {

        }
         
        if ($request->filenameBG) {
            $filenameBG = $request->filenameBG;
            $storage_path = env('DO_URL').'/public/images/themes/'.$filenameBG;
            $db->background = $storage_path;
            // $request->file('pictureBG')->storeAs('public/images/themes', $filenameBG);
            $request->file('pictureBG')->storePubliclyAs('public/images/themes',  $filenameBG, $dev);
        } else {

        }

        if ($request->filenameIcon) {
            $filenameIcon = $request->filenameIcon;
            $storage_path = env('DO_URL').'/public/images/themes/'.$filenameIcon;
            $db->banner_icon = $storage_path;
            // $request->file('pictureIcon')->storeAs('public/images/themes', $filenameIcon);
            $request->file('pictureIcon')->storePubliclyAs('public/images/themes',  $filenameIcon, $dev);
        } else {

        }

        $db->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Themes  $themes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Themes $themes, Request $request)
    {
        Themes::find($request->id)->delete();
        return response('deleted', 201);
    }

    public function selectThemes($themeid)
    {
        $store = Helpers::selected_store();
        $storeselected = Themes::where('storeid', $store->id)
                        ->where('used_themes', 1)->get();

        if ($storeselected->isEmpty()) {
            $db = Themes::find($themeid);
            $db->used_themes = true;
            $db->update();
        } else {
            $db = Themes::find($storeselected[0]['id']);
            $db->used_themes = false;
            $db->update();

            if ($db->update()) {
                $db1 = Themes::find($themeid);
                $db1->used_themes = true;
                $db1->update();
            }
        }
        return response('updated', 201);
    }
}
