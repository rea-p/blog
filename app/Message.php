<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{ 

    // public static function getmessages(){

        
    //       $message=DB::table('messages')->orderBy('id', 'asc')->get();
       
    //       return $messages;
      
    //   }

    protected $table='messages';
}
