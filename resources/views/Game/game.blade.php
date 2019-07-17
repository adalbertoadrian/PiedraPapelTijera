@extends('layouts.app')
@section('content')
@if(!empty($status))
    <div class="alert alert-danger">{{ $status }}</div>
@endif
<div class="container">
    <h1>Round {{ $data["round_number"] }}</h1>
    <h2>{{ $data["player_turn_name"] }}</h2>
    {{ Form::open(['url' => 'game/match']) }}
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('move_id', 'Move') }}
                {{ Form::select('move_id',$data["moves"], 1, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::submit('OK', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
        <div class="col-sm-8">
            @if($data["round_number"] == 3)

            @endif
        </div>
    </div>
    {{ Form::hidden('game_id', $data["game_id"]) }}
    {{ Form::hidden('round_number', $data["round_number"]) }}
    {{ Form::hidden('player_number', $data["player_number"]) }}
    {{ Form::hidden('player_turn_name', $data["player_turn_name"]) }}
    {{ Form::close() }}
</div>
@endsection