<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chat;
use App\Message;
use App\User;
use Auth; 
use Redirect,Response,DB,Config;

class ChatController extends Controller
{
    public function index(){


        $messages=Message::all();
    
        return view ('chat',['msg' => Message::find($messages)])->with('messages',$messages);
    }

    public function getMessage(Request $request){
            
        $messages = DB::table('messages')
            ->join('users', 'users.id', '=', 'messages.userid')
            ->select('messages.id as messagesid', 'messages.msg', 'users.id as usersid', 'users.name')
            ->get();
    
            return Response::json($messages);
    }

    public function sendMessage(Request $request){
              
        $user_id = Auth::user()->id;
            $message = new Message;
            $message->userid = $user_id;
            $message->msg = $request->message;
     
            $message->save();
     
            return response($message);
    }
        
    public function update(){
        $messages = DB::table('messages')
            ->join('users', 'users.id', '=', 'messages.userid')
            ->select('messages.id as messagesid', 'messages.msg', 'users.id as usersid', 'users.name')
            ->get();
            
            return Response::json($messages);
    }

}      
            

        

        





