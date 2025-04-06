<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.show_user',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
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