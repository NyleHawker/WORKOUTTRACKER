<?php

namespace App\Http\Controllers;

use App\Models\CustomWorkout;
use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use Carbon\Carbon;

class PagesController extends Controller
{
    
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'about']]);
    }

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
        $foods = Food::where('food', 'LIKE', '%' . strtolower($searchFood) . '%')->paginate(2);

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
        // query current user..
        $user_id = Auth()->user()->id;
        // query
        $searchExercise = $request->input('exerciseSearch');
        $exercises = Exercise::where('exercise', 'LIKE', '%' . strtolower($searchExercise) . '%')->paginate(5);
        $customworkouts = CustomWorkout::where([
            ['workout', 'LIKE', '%' . strtolower($searchExercise) . '%'],
            ['user_id', 'LIKE', $user_id]
        ])->paginate(5);

        return view('tasks.exercise', [
            'exercises' => $exercises,
            'customworkouts' => $customworkouts
        ]);
    }
    public function showexercise($id) {
        $exercise = Exercise::find($id);

        return view('tasks.showexercise', [
            'exercise' => $exercise
        ]);
    }
    // custom workout
    public function addExercise(Request $request) {

        // valid empty field
        $this->validate($request, [
            'exerciseName' => 'required'
        ]);

        // store exercise..
        $exercise = new CustomWorkout();

        $exercise->workout = $request->exerciseName;
        $exercise->user_id = auth()->user()->id;

        // save..
        $exercise->save();

        return redirect('/exercise')->with('success', 'An Exercise has been added!');
    }
    public function showworkout($id) {
        $customworkout = CustomWorkout::find($id);

        return view('tasks.showworkout', [
            'customworkout' => $customworkout
        ]);
    }
    public function destroyWorkout($id) {
        $exercise = CustomWorkout::find($id);
        $exercise->delete();

        return redirect('/exercise')->with('success', 'Exercise has been deleted');
    }

    // start workout
    public function startworkout() {
        $start = Carbon::now();

        return view('tasks.workout', [
            'start' => $start
        ]);
    }
    /*public function duration() {
        $current = 
    }*/

    /**
     * tracker page
     */
    public function tracker() {
        $user = Auth()->user()->name;

        return view('tasks.tracker')->with('user', $user);
    }

}
