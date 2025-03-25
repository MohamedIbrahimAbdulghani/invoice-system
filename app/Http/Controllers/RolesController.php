<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    function __construct()
    {
    
    // $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
    // $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
    // $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
    // $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    
    }
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {

    }

    public function store()
    {
        
    }

    public function show()
    {
        
    }

    public function edit()
    {

    }
    public function update()
    {
        
    }

    public function destroy()
    {
    
    }
}