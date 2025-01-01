<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddedSectionValidation;
use App\Http\Requests\UpdatedSectionValidation;
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
    public function store(AddedSectionValidation $request)
    {
        sections::create([
            "section_name"=>$request->section_name,
            "description"=>$request->description,
            "created_by"=>Auth::user()->name
        ]);
        session()->flash('Add','تم إضافة القسم بنجاج');
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
    public function update(UpdatedSectionValidation $request)
    {
        $id = $request->id;
        $sections = sections::findOrFail($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session()->flash('Edit','تم تعديل القسم بنجاج');
        return redirect('sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        sections::findOrFail($id)->delete();
        session()->flash('Delete', 'تم حذف المنتج بنجاح');
        return redirect("sections");
    }
}