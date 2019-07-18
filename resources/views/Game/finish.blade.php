@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>We have a WINNER!!</h1>
        <h2>{{ strtoupper($winner) }} is the new EMPEROR!</h2>
        <a href="/" class="btn btn-primary" role="button">Play Again</a>
    </div>
@endsection