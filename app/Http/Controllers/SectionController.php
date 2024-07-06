<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return view("sections.section",  compact("sections"));
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
    public function store(ValidationRequest $request)
    {
        /***************************************************************************
         *
         * this is first type for make a validation
                $input = $request->all();
                $b_exists = Section::where("section_name", "=", $input["section_name"])->exists();  // للتاكيد اذا كان القسم متسجل قبل كدا ولا لا
                if($b_exists) {
                    session()->flash("Error", "خطأ القسم مسجل سابقآ");
                    return redirect("/section");
                } else {
                    Section::create([
                        "section_name" => $request->section_name,
                        "description" => $request->description,
                        "created_by" => (auth()->user()->name)
                    ]);
                    session()->flash("Add", "تم إضافة القسم بنجاح");
                    return redirect("/section");
                }

        ***************************************************************************/


        // this is second type for make a validation

        // $validation = $request->validate([
        //     'section_name' => 'required|unique:sections|max:255',
        //     'description' => 'required',
        // ] ,[
        //     'section_name.required'=>'يرجي ادخال اسم القسم',
        //     'section_name.unique'=>' اسم القسم مسجل مسبقا ',
        //     'description.required'=>'يرجي ادخال الملاحظات ',
        // ]);

        $validated = $request->validated();
        Section::create([
            "section_name" => $request->section_name,
            "description" => $request->description,
            "created_by" => (auth()->user()->name)
        ]);
        session()->flash("Add", "تم إضافة القسم بنجاح");
        return redirect("/section");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $section = Section::findOrFail($request->id);
        $section->update([
            "section_name" => $request->section_name,
            "description" => $request->description
        ]);
        session()->flash("Edit", "تم تعديل القسم بنجاح");
        return redirect("/section");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $section = Section::findOrFail($request->id);
        $section->delete();
        session()->flash("Delete", "تم حذف القسم بنجاح");
        return redirect("/section");
    }
}
