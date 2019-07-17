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
        Match::insert([
            "game_id" => $request->game_id,
            "round_number" => $request->round_number,
            "player_turn_name" => $request->player_turn_name,
            "created_at" => "NOW()",
            "updated_at" => "NOW()"
        ]);
        
        $player_number = ($request->player_number == 1) ? 2 : 1;
        $player = "player".$player_number." AS player";
        $round_match = Match::select("id")->where([
            ["round_number", $request->round_number],
            ["game_id", $request->game_id],
        ])->get();
        $round_number = (count($round_match) == 2) ? $request->round_number + 1 : $request->round_number;
        $player_turn_name = Game::select($player)->where("id", $request->game_id)->first();
        if($round_number <= 3) {
            $data = [
                "game_id" => $request->game_id,
                "player_number" => $player_number,
                "player_turn_name" => $player_turn_name->player,
                "round_number" => $round_number,
                "moves" => Move::select("id", "move")->pluck("move", "id")
            ];
            if($round_number == 3) {
                
            }
            return view("Game.game", ["data" => $data]);
        } else {
            $this->finish($request->game_id);
        }
    }
    private function finish($game_id){
        dd("Fin");
    }
}
