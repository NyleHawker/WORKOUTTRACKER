<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    
    /**
     * return default index..
     */
    public function index() {

        return view('index');

    }

    /**
     * return about page..
     */
    public function about() {
        $authors = array('Em Vannin', 'Keo Leangchoue', 'Lang Singchheng');
        return view('about', [
            'authors' => $authors
        ]);
    }

    // tasks components..`
    /**
     * return routines..
     */
    public function routines() {
        $user = Auth()->user()->name;
        return view('tasks.routines')->with('user', $user);
    }

}
