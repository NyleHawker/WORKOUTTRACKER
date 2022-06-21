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
                    <a href="/tracker" class="nav-link active">
                      <i class="fa fa-history"></i>
                      Tracker
                    </a>
                  </li>
                </ul>
                <hr>
              </div>

        </div>
        <div class="col-9 p-0">
            
            <h2 style="color:rgb(7, 156, 156)"><i class="fa fa-bookmark"></i> {{ $user }}</h2>
            
            <table class="mt-2 mb-0 table table-secondary table-hover table-bordered border-white text-secondary">
              <tbody>
                <tr>
                  <td class="h4 text-success">Duration</td>
                  <td class="h4 text-success">Workouts</td>
                </tr>
                <tr>
                  <td class="h5"><i class="fa fa-hourglass"></i>
                    @php
                      echo gmdate('i', $sum_duration);
                      echo "mn";
                      echo gmdate('s', $sum_duration);
                      echo "s";
                    @endphp
                  </td>
                  <td class="h5"><i class="fa fa-dumbbell"></i> {{ $sum_sets }}</td>
                </tr>
              </tbody>
            </table>
            <table class="mt-0 mb-4 table table-secondary table-hover table-bordered border-white text-secondary">
              <tbody>
                <tr>
                  <td class="h4 text-success">Last Workout</td>
                </tr>
                <tr>
                  <td class="h5">
                    @if (empty($last_workout->created_at))
                      None...
                    @else
                      {{$last_workout->created_at->diffForHumans()}}
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
            
            <h2 class="text-secondary">Workouts History</h2>

            <div class="list-group">
              @if (count($workouteds) > 0)
                  @foreach ($workouteds as $workouted)
                  <div class="list-group-item list-group-item-action p-3 mb-2 border">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1 text-success"><i class="fa fa-running"></i>
                          @php
                            echo gmdate('i', $workouted->total_duration);
                            echo "mn";
                            echo gmdate('s', $workouted->total_duration);
                            echo "s";
                          @endphp
                      </h5>
                      <small>{{ $workouted->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="text-muted">

                      @foreach ($dones as $done)
                          @if ($done->workout_id == $workouted->id)
                            {{ $done->workout_name }} <i class="fa fa-times text-danger"></i>
                            {{ $done->count_row }}
                            <br>
                          @endif
                      @endforeach

                    </p>
                  </div>
                  @endforeach
              @else
                <div class="text-secondary h4">No workouts..</div>
              @endif

              {{ $workouteds->links() }}

            </div>

        </div>

    </div>

    <br><br><br>

@endsection