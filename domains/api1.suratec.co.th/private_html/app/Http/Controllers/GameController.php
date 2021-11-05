<?php

namespace App\Http\Controllers;
use App\RunnerMaze;
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
       public function gamerunnermazelist(Request $request){
          // dd($request->all());
           $data = RunnerMaze::where('game_id',$request->game_id)->where('mission_id',$request->mission_id)->where('user_id',$request->user_id);
           if(isset($request->start_date) && $request->start_date !='' && isset($request->end_date) && $request->end_date !=''){
                $data =$data->where('created_at','>=',$request->start_date);
                $data =$data->where('created_at','<=',$request->end_date);
           }           
           $data =$data->latest('id')->paginate($request->limit);
           if($data){
                return response()->json(['status' => 'OK','data' => $data,'message' => 'Game Data Listing'], 201);
            }else{
                return response()->json(['status' => 'OK','data' => $data,'message' => 'No Data Found'], 401);
           }
           
       }
       public function gamerunnermaze(Request $request){
        $validator = \Validator::make($request->all(), [
            'user_id' =>'required',
            'total_score' =>'required',
            'distance' =>'required',
            'timer_gameplay' =>'required',
            'timestamp' =>'required',
            'bonus_fail' =>'required',
            'bonus_success' =>'required',
            'mission_id' =>'required',
            'mission_name' =>'required',
            'game_id' =>'required'
        ]);
     
        if ($validator->fails()) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'validation_errors',
                'errors' => $validator->errors()
            ], 422);
        }
            $runnermaze = new RunnerMaze();
            $runnermaze->user_id = $request->user_id;
            $runnermaze->total_score = $request->total_score;
            $runnermaze->distance = $request->distance;
            $runnermaze->timer_gameplay = $request->timer_gameplay;
            $runnermaze->timestamp = $request->timestamp;
            $runnermaze->bonus_fail = $request->bonus_fail;
            $runnermaze->bonus_success = $request->bonus_success;
            $runnermaze->mission_id  = $request->mission_id;
            $runnermaze->mission_name = $request->mission_name;
            $runnermaze->game_id = $request->game_id;
            if ($runnermaze->save()) {                 
                return response()->json(['status' => 'OK','data' => $runnermaze,'message' => 'Game data create successfully'], 201);
            }else{
                return response()->json(['status' => 'ERROR','data' => $request->all(),'message' => 'Unable to create an Game data'], 401);
            }
       }

}

