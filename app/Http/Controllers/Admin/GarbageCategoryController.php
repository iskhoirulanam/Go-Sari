<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GarbageCategory;
use Illuminate\Http\Request;

class GarbageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = GarbageCategory::all();;
        return view('admin.garbage-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.garbage-categories.create-category');
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
        // dd($request->all());
        $this->validate($request, [
            'category_name' => 'required',
            'price' => ['required', 'numeric']
        ]);

        GarbageCategory::create([
            'category_name' => $request->category_name,
            'price' => $request->price
        ]);
        return redirect()->route('garbage-categories.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = GarbageCategory::find($id);
        return view('admin.garbage-categories.edit-category', compact('category'));
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
        //
        $this->validate($request, [
            'category_name' => 'required',
            'price' => ['required', 'numeric']
        ]);

        $edit = GarbageCategory::find($id);
        $edit->category_name = $request->category_name;
        $edit->price = $request->price;
        $edit->save();
        return redirect()->route('garbage-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $gbCategories = GarbageCategory::find($id);
        $gbCategories->delete();
        return redirect()->route('garbage-categories.index');
    }
}
