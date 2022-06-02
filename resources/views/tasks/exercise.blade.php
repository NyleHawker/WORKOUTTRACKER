@extends('layouts.app')

@section('content')
    <br>
    <div class='row'>

        <div class="col-3">
            
            <div class="d-flex rounded flex-column flex-shrink-0 p-3 text-white bg-dark">
                <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                  <i class="fa fa-book"></i>
                  <span class="fs-4">&nbspLog</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                  <li class="nav-item">
                    <a href="/routines" class="nav-link text-white" aria-current="page">
                      <i class="fa fa-tasks"></i>
                      Routines
                    </a>
                  </li>
                  <li>
                    <a href="/exercise" class="nav-link text-white active">
                      <i class="fa fa-walking"></i>
                      Exercise
                    </a>
                  </li>
                  <li>
                    <a href="/food" class="nav-link text-white">
                      <i class="fa fa-egg"></i>
                      Food
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link text-white">
                      <i class="fa fa-history"></i>
                      Tracker
                    </a>
                  </li>
                </ul>
                <hr>
              </div>

        </div>
        <div class="col-9">
            
            <div class="p-0 mt-2 d-flex flex-row justify-content-between align-items-center">
                <h3 class="m-0 p-0">All Exercises</h3>
                <form action="/exercise" method="GET" class="m-0">
                    <div class="input-group m-0">
                      <input type="search" id="exerciseSearch" name="exerciseSearch" class="form-control rounded" placeholder="Find exercise.." />
                      <button type="submit" class="btn btn-outline-primary">search</button>
                    </div>
                </form>
            </div>
            <hr>

            <div class="list-group">
            @if (count($exercises) > 0) 
                
              @foreach ($exercises as $exercise)
  
                @if (!empty($exercise->instruction))
                    
                <a href="/showexercise/{{ $exercise->id }}" class="list-group-item list-group-item-action align-middle" height="2rem">
                  <span class="h4">{{ $exercise->exercise }}<span>
                  <img width="28px" height="28px" src="{{asset($exercise->imgpath)}}" class="rounded float-end" alt="...">&nbsp;
                  <span class="badge bg-info rounded float-start">p</span>
                </a>

                @else

                <a href="/showexercise/{{ $exercise->id }}" class="list-group-item list-group-item-action align-middle" height="2rem">
                  <span class="h4">{{ $exercise->exercise }}<span>
                  <img width="28px" height="28px" src="{{asset('images/empty.png')}}" class="rounded float-end" alt="...">
                </a>
                    
                @endif

              @endforeach

              <hr>

              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Add An Exercise?
                </button>
                <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton1">
                    <form action="/addExercise" method="GET">

                      <input type="search" id="exerciseName" name="exerciseName" class="form-control rounded" placeholder="Exercise's Name.." />
                      <br>
                      <button type="submit" class="btn btn-light border border-dark">Add Exercise!</button>

                    </form>
                </div>
              </div>

            @else
                
              <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">No Exercise...</h4>
                <hr>
                @for ($i = 0; $i < 10; $i++)
                  <i class="fa fa-walking"></i>
                @endfor
              </div>

            @endif
            
            </div>

        </div>

    </div>

    <br><br><br>

@endsection