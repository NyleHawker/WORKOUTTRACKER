<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;

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
    /**
     * return food..
     */
    public function food(Request $request) {
        // query
        $searchFood = $request->input('foodsearch');
        // when pushing to heroku, comment out the below code..
        $foods = Food::where('food', 'ilike', "%{$searchFood}%")->paginate(2);

        // validate
        /*$this->validate($request, [
            'foodsearch' => 'required'
        ]);*/

        return view('tasks.food', [
            'foods' => $foods
        ]);
    }

}
