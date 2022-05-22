@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Workout Tracker 101</h1>
    <p>This is our final project</p>
    @if (count($authors) > 0)
        @foreach ($authors as $author)
            <footer class="blockquote-footer">{{ $author }}</footer>
        @endforeach
    @endif
</div>
@endsection