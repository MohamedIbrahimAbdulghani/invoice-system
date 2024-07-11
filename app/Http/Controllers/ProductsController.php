<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        $products = Products::all();
        return view("products/product", compact("sections", "products"));
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
        Products::create([
            "product_name" => $request->product_name,
            "description" => $request->description,
            "section_id" => $request->section_id,
        ]);
        session()->flash("Add", "تم إضافة المنتج بنجاح");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product = Products::findOrFail($request->id);
        $product->update([
            "product_name" => $request->product_name,
            "description" => $request->description,
        ]);
        session()->flash("Edit", "تم تعديل المنتج بنجاح");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Products::findOrFail($request->id);
        $product->delete();
        session()->flash("Delete", "تم حذف المنتج بنجاح");
        return back();
    }
}
