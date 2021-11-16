<?php

namespace App\Http\Controllers;

use App\Models\UserAssignedStore;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Helpers;
use DB;

class UserAssignedStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Helpers::stores();
        $users = User::with('user_assigned', 'store_assigned')->where('email', '!=', 'klp-admin@gmail.com')->get();
        return view('users', compact('users', 'stores'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAssignedStore  $userAssignedStore
     * @return \Illuminate\Http\Response
     */
    public function show(UserAssignedStore $userAssignedStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAssignedStore  $userAssignedStore
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAssignedStore $userAssignedStore, $userid)
    {
        $userAssignedstore = UserAssignedStore::where('userid', $userid)->get();
        return $userAssignedstore;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAssignedStore  $userAssignedStore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAssignedStore $userAssignedStore)
    {
        $db = UserAssignedStore:: updateOrCreate([
            'userid' => $request->userid
        ],[
            'storeid' => $request->storeid
        ]);

        return response('updated', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAssignedStore  $userAssignedStore
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAssignedStore $userAssignedStore)
    {
        //
    }
}
