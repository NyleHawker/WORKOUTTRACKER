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
                    <a href="/routines" class="nav-link active" aria-current="page">
                      <i class="fa fa-tasks"></i>
                      Routines
                    </a>
                  </li>
                  <li>
                    <a href="/exercise" class="nav-link text-white">
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
                    <a href="/tracker" class="nav-link text-white">
                      <i class="fa fa-history"></i>
                      Tracker
                    </a>
                  </li>
                </ul>
                <hr>
              </div>

        </div>
        <div class="col-9 p-0">

            <a href="/routines" class="btn btn-success">Go Back</a>

            <div class="container mt-1 p-2 rounded" style="background-color: #cccccc;">

              <button onclick="startTimer()" class="btn btn-success">Start</button>

              <div id="timer">
                <i class="fa fa-clock"></i>
                <span id="minutes">00</span>:<span id="seconds">00</span>
              </div>

            </div>

        </div>

    </div>

    {{-- instant script --}}
    <script>
        var second = 0;
        function pad ( value ) { return value > 9 ? value : "0" + value; }
        function startTimer() {
          var timer = setInterval( function(){
            document.getElementById("seconds").innerHTML=pad(++second%60);
            document.getElementById("minutes").innerHTML=pad(parseInt(second/60,10));
          }, 1000);
        }
        function stopTimer() {
          clearInterval(timer);
          alert(second);
        }
    </script>

@endsection