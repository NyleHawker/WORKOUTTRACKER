@extends('layouts.app')

@section('content')

    <h1>HOMEPAGE</h1>
    <!-- check user access controls -->
    @if (Auth::guest())
        <p>Welcome to our workout log.</p>
    @else
        <p>Welcome again {{ Auth::user()->name }}</p>
    @endif

@endsection

