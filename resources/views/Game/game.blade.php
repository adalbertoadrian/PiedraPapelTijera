<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>PiedraPapelTijera</title>
</head>
<body>
    <div class="container">
        <h1>Round {{ $data["round_number"] }}</h1>
        <h2>{{ $data["player_turn_name"] }}</h2>
        {{ Form::open(['url' => 'game/match']) }}
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    {{ Form::label('move', 'Move') }}
                    {{ Form::select('move',$data["moves"], 1, ['class' => 'form-control']) }}
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>