<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddedProductValidation;
use App\Http\Requests\UpdateProductValidation;
use App\Models\Products;
use App\Models\sections;
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
        $sections = sections::all();
        $products = Products::all();
        return view("products.products", compact("sections", "products"));
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
    public function store(AddedProductValidation $request)
    {
        Products::create([
            "product_name"=>$request->product_name,
            "description"=>$request->description,
            "section_id"=>$request->section_id,
        ]);
        session()->flash('Add','تم إضافة المنتج بنجاج');
        return redirect("products");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
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
    public function update(UpdateProductValidation $request, Products $products)
    {
        $products = Products::findOrFail($request->product_id);

        $products->update([
            'product_name'=>$request->product_name,
            'section_id'=>$request->section_id,
            'description'=>$request->description,
        ]);
        session()->flash('Edit', 'تم تحديث البيانات بنجاح');
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Products::findOrFail($request->product_id)->delete();
        session()->flash('Delete', 'تم حذف المنتج بنجاح');
        return redirect('products');
    }
}