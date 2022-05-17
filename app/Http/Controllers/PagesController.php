<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    /**
     * return default index
     */
    public function index() {
        return view('index')->with('title', 'Home');
    }

}
