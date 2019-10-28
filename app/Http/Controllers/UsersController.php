<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Redirect,Response,DB,Config;
use Datatables;
use App\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
        
    { 
        //   $id = $request->user_id;
        //   print_r($id);exit;
       
  
        $deps=Department::all();
        return view ('users.index')->with('deps',$deps);
        
    }
    public function dep()
    {
        return DB::table('users')
        ->join('department','department.id', '=', 'users.id_dep')
        ->select('users.id','users.name','users.email','department.title')
        ->get();

    }

    public function usersList()
    {
        // $users = DB::table('users')->select('*');
        $users = DB::table('users')
        ->join('department','department.id', '=', 'users.id_dep')
        ->select('users.id','users.name','users.email','department.title')
        ->get();
    //    print_r($users);exit;
        // return datatables()->of($users)
        return datatables()->of($users)
                ->addColumn('action', ' 
                                       <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $id }}" data-original-title="Edit" class="edit btn btn-success edit-user" >  Edit</a>    
                                       <a href="javascript:void(0);" id="delete-user" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $id }}" class="delete btn btn-danger" style="margin:20px">Delete</a>')
                ->rawColumns(['action'])
                
                ->addIndexColumn()
            ->make(true);

           
            // return view('',compact('user_report', 'user_imei'));
            

           
           

            
        
               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
       $this->validate ($request,[
           'name' => 'required',
           'email' => 'required',
           'password' => 'required',
           'role' => 'required',
           'id_dep' => 'required'
       ]); 
       
       $user= new user();
       $user->name = $request->input('name');
       $user->email = $request->input('email');
       $user->password = Hash::make(Input::get('password'));
       $user->id_dep = $request->input('id_dep');
       $user->role = $request->input('role');
       $user->photo = $request->input('photo')? "uploads/images/".$request->input('photo') : "uploads/images/default.png";

       $user->save();
  
       return redirect('/users')->with('success', 'User Created') ;
    } 
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 

    }/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $user  = User::where($where)->first();

        $user->save();
            
        return Response::json($user);
    }

    public function updateAjax(Request $request)
    {
       
        $userId = $request->user_id;
        
        $user =  User::updateOrCreate(['id' => $userId],
            ['name' => $request->name, 'email' => $request->email,'role' => $request->role,'id_dep' => $request->id_department]);  
               
        return Response::json($user);
       
    }

    /**  
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate ($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'id_dep' => 'required',
            'photo' => 'required'
        ]); 
 
        
        $user= User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make(Input::get('password'));
        $user->id_dep = $request->input('id_dep');
        $user->role = $request->input('role');
        $user->photo = $request->input('photo');
        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $user->photo = $filePath;
        }
        else {

            $user->photo = '/uploads/images/default.png'; 
        }
 
        $user->save();
 
        return redirect('/users') ;
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();
 
        return Response::json($user);
    }
}








