<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Exception;

class GameController extends Controller
{
    function Insert(Request $request){
         $game = Game::where('id_customer', $request->id_customer)->where('level', $request->level)->where('type' , $request->type)->first();
            if($game){
                if($game->score < $request->score){
                    $game->score = $request->score;
					$game->victory = $request->victory;

                    
                }
            }
            else{
                $game = new Game();
                $game->id_customer = $request->id_customer;
                $game->type = $request->type;
                $game->score = $request->score;
                $game->action_datetime = date('Y-m-d H:i:s');
                $game->level = $request->level;
                $game->victory = $request->victory;
            }
            try{
                $game->save();
                return 'success';
            }catch(Exception $e){
                return $e;
            }
    }

    function Query(Request $request){

        $game = Game::where('level','=', $request->level)->where('type','=', $request->type)->orderBy('score', 'desc')->take(3)->get();

        return $game;
    }

    function Level(Request $request){

        /*$level = Game::where('id_customer', $request->id_customer)->where('type','=', $request->type)->max('level')->get();*/
        $level = Game::where('id_customer', $request->id_customer)->where('type','=', $request->type)->where('victory','=', 1)->max('level');
        return $level;

        
    }

    public function setMD5(){

        $passuniq = uniqid();
        $passmd5 = md5($passuniq);
    
        $sumlenght = strlen($passmd5);#num passmd5
    
        $letter_pre = chr(rand(97,122));#set char for prefix
    
        $letter_post = chr(rand(97,122));#set char for postfix
    
        $letter_mid = chr(rand(97,122));#set char for middle string
    
        $num_rand = rand(0,$sumlenght);#random for cut passmd5
    
        $cut_pre = substr($passmd5,0,$num_rand);#cutmd5 start 0 stop $numrand
        $setmid = $cut_pre.$letter_mid;#set pre string + char middle
    
        $cut_post = substr($passmd5,$num_rand, $sumlenght+1);
    
        $set_modify_md5 = $letter_pre.$setmid.$cut_post.$letter_post;
        return $set_modify_md5;
    
       }

}