<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\User;
use Redirect,Response,DB,Config;
use Datatables;

class TreeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/tree');
    }
   
    public function getTree(){

        $rows =Department::all();
        $data = array();

        foreach($rows as $row) { 
            $d = array();
            if ($row->id_dep==0)
            {
                $d['parent']='#';
            }else{ 
                
                $d['parent'] = $row->id_dep;
            }
            $d['id']=$row->id;
            $d['text']=$row->title;

            array_push($data,$d);
        }
        return Response::json($data);   

    }
    public function getAllUser(Request $request){
        
        $dep_id = $request->id;
        $usersQuery = User::query();
        $dep_id = (!empty($_GET["id"])) ? ($_GET["id"]) : ('');

        if($dep_id){
            $usersQuery->whereRaw("(users.id_dep) = ".$dep_id );
        }
        $users = $usersQuery->select('*');
        return datatables()->of($users)
        ->make(true);
       
    }

}
