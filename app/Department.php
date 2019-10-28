<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';

    protected $fillable = [
        'id_dep', 'title', 'description'
    ];
    
    public function user(){

        return $this->hasMany('App\User');
    }
}
