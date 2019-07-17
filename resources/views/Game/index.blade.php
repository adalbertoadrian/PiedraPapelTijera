@extends('layouts.app')
@section('content')
@if(Session::has('status'))
    <div class="alert alert-danger">{{ Session::get('status') }}</div>
@endif
<div class="container">
    <h1>Piedra Papel o Tijera</h1>
    {{ Form::open(['url' => 'game/start']) }}
    <div class="form-group">
        {{ Form::label('player1', 'Player1') }}
        {{ Form::text('player1', '', ['class' => 'form-control', 'required' => true]) }}
    </div>
    <div class="form-group">
        {{ Form::label('player2', 'Player2') }}
        {{ Form::text('player2', '', ['class' => 'form-control', 'required' => true]) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Start', ['class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}
</div>
@endsection