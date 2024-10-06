<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionsValidate;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view("sections.sections", compact("sections"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionsValidate $request)
    {
        /* **********************   this is first type to make validation  ************

        $input = $request->all();
        $check_section_exist = sections::where("section_name","=",$input["section_name"])->exists();
        if($check_section_exist):
            session()->flash("Error", "خطأ القسم موجود مسبقآ");
            return redirect("sections");
        else:
            sections::create([
                "section_name"=>$request->section_name,
                "description"=>$request->description,
                "created_by"=>Auth::user()->name
            ]);
            session()->flash("Add", "تم إضافة القسم بنجاح");
            return redirect("sections");
        endif;

        */

        /* **********************   this is second type to make validation  ************

        $validation = $request->validate([
            "section_name"=>"required|unique:sections|max:255",
            "description"=>"required",
        ],[
            "section_name.required"=>"يرجي إدخال اسم القسم ",
            "description.required"=>"يرجي إدخال الوصف",
        ]);

        sections::create([
            "section_name"=>$request->section_name,
            "description"=>$request->description,
            "created_by"=>Auth::user()->name
        ]);
        session()->flash("Add", "تم إضافة القسم بنجاح");
        return redirect("sections");

        */
        $validation = $request->validate();
        return redirect("sections");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sections $sections)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(sections $sections)
    {
        
    }
}