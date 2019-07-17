<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Move;
use App\Match;

class GameController extends Controller
{
    public function start(Request $request){
        if($request->player1 == $request->player2) {
            return redirect('/')->with('status', 'Ambos Jugadores no pueden tener el mismo nombre.');
        } else {
            //Inicializo el Juego
            $game_id = Game::insertGetId([
                "player1" => $request->player1, 
                "player2" => $request->player2, 
                "created_at" => "NOW()",
                "updated_at" => "NOW()"
            ]);
            $data = [
                "game_id" => $game_id,
                "player_number" => 1,
                "player_turn_name" => $request->player1,
                "round_number" => 1,
                "moves" => Move::select("id", "move")->pluck("move", "id")
            ];
        }
        return view("Game.game", ["data" => $data]);
    }
    public function match(Request $request){
        //Inserto Jugada
        Match::insert([
            "game_id" => $request->game_id,
            "round_number" => $request->round_number,
            "player_turn_name" => $request->player_turn_name,
            "move_id" => $request->move_id,
            "created_at" => "NOW()",
            "updated_at" => "NOW()"
        ]);
        //Cambio el numero del jugador
        $player_number = ($request->player_number == 1) ? 2 : 1;
        $player = "player".$player_number." AS player";
        $player_turn_name = Game::select($player)->where("id", $request->game_id)->first();
        //Verifico si es la segunda jugada de la ronda para pasar a la proxima
        $round_match = Match::select("id")->where([
            ["round_number", $request->round_number],
            ["game_id", $request->game_id],
        ])->get();
        //Si ambos jugadores seleccionaron la misma opcion es un empate y se mantiene en la misma ronda
        $draw = false;
        if(count($round_match) == 2) {
            $plays = Match::select("move_id")->where([
                ["game_id", $request->game_id],
                ["round_number", $request->round_number],
            ])->get()->toArray();
            if($plays[0]["move_id"] == $plays[1]["move_id"]){
                $round_number = $request->round_number;
                //Al ser empate borro el match
                Match::where([
                    ["game_id", $request->game_id],
                    ["round_number", $request->round_number],
                ])->delete();
                $draw = true;
            } else {
                $round_number = $request->round_number + 1;
            }
        } else {
            $round_number = $request->round_number;
        }
        //El juego continua mientras el numero de rondas es menor igual a 3 de lo contrario muestra la patalla de score
        if($round_number <= 3) {
            $data = [
                "game_id" => $request->game_id,
                "player_number" => $player_number,
                "player_turn_name" => $player_turn_name->player,
                "round_number" => $round_number,
                "moves" => Move::select("id", "move")->pluck("move", "id")
            ];
            //Si es la tercera ronda muestro el cuadro de puntaje
            if($round_number == 3) {
                $plays = Match::select("move_id", "player_turn_name", "round_number")->where("game_id", $request->game_id)->get();
                $plays = $plays->groupBy('round_number')->toArray();;
                //dd($plays);
            }
            if($draw == true) {
                return view("Game.game", ["data" => $data])->with('status', 'Empate, Seleccioné de Nuevo');
            } else {
                return view("Game.game", ["data" => $data]);
            }
        } else {
            return view("Game.finish");
        }
    }
}
