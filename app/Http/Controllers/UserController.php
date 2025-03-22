<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
return view('users.show_users',compact('data'))
->with('i', ($request->input('page', 1) - 1) * 5);
        // return view('users.show_users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

 
    public function show()
    {
        //
    }

    
    public function edit()
    {
        //
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy()
    {
        //
    }
}