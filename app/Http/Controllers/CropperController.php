<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CropperController extends Controller
{
    public function index()
    {
        return view('cropper');
    }
}
