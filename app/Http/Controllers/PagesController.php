<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
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

    // tasks components..

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

    /**
     * return all exercise related pages..
     */
    public function exercise(Request $request) {
        // query
        $searchExercise = $request->input('exerciseSearch');
        $exercises = Exercise::where('exercise', 'LIKE', "%{$searchExercise}%")->paginate(10);

        return view('tasks.exercise')->with('exercises', $exercises);
    }
    public function showexercise($id) {
        $exercise = Exercise::find($id);

        return view('tasks.showexercise')->with('exercise', $exercise);

    }
    public function addExercise(Request $request) {

        // valid empty field
        $this->validate($request, [
            'exerciseName' => 'required'
        ]);

        // store exercise..
        $exercise = new Exercise();

        $exercise->exercise = $request->exerciseName;
        $exercise->instruction = "";
        $exercise->imgpath = "";

        // save..
        $exercise->save();

        return redirect('/exercise')->with('success', 'An Exercise has been added!');
    }

}
