<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Redirect,Response,DB,Config;
use Datatables;


class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    public function index()
    {
        $deps=Department::all();
        return view('dep')->with('deps',$deps);
    }

    public function depList()
    {
        $deps = DB::table('department')->select('*');
            return datatables()->of($deps)
                ->addColumn('action', '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $id }}" data-original-title="Edit" class="edit btn btn-success edit-dep" >  Edit</a>    
                             <a href="javascript:void(0);" id="delete-dep" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $id }}" class="delete btn btn-danger" style="margin:20px">
                                    Delete
                            </a>')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $depId = $request->department_id;
        
        $dep   =   Department::updateOrCreate(['id' => $depId],
                ['id_dep' => $request->id_department, 'title' => $request->title, 'description' => $request->description]);
        return Response::json($dep);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $dep  = Department::where($where)->first();

        $dep->save();
 
        return Response::json($dep);
    }
    /**
     * Update the specified resource in storage. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $depId = $request->department_id;
        $depChildrens = Department::where('id_dep',$depId)->get();
        if(count($depChildrens)>0){ 
            foreach ($depChildrens as $depChildren) {
                DB::table('department')
                    ->where('id_dep', $depId)
                    ->update(['id_dep' => 0]);
                $dep =   Department::updateOrCreate(['id' => $depId],
                    ['id_dep' => $request->id_department, 'title' => $request->title,'description' => $request->description,]);        
                return Response::json($dep);          
            }
        }else{

        $dep =   Department::updateOrCreate(['id' => $depId],
                ['id_dep' => $request->id_department, 'title' => $request->title,'description' => $request->description,]);        
        return Response::json($dep);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  $dep_id = request('id');
        $depChildrens=Department::where('id_dep',$id)->get();
        $dep = Department::where('id',$id)->get();
        $id_parent = $dep[0]['id_dep'];
        
        
        if ($id_parent!=0){
            $resp = array();
            $resp['message'] = 'Department deleted!';
            if(count($depChildrens)>0){ 
               
                DB::table('department')->where('id_dep',$id)->update(['id_dep'=>$id_parent]);
            }
            $dep=Department::where('id',$id)->delete();
                    
            return Response::json($resp);  
                    
        }else{
            DB::table('department')->where('id_dep',$id)->update(['id_dep'=> 0]); 
            $dep=Department::where('id',$id)->delete();
            $resp = array();
            $resp['message'] = 'Department deleted!';
            return Response::json($resp);
        }  
    }
}
     
      
    

