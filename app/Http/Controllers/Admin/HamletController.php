<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hamlet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HamletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hamlets = Hamlet::all();
        return view('admin.hamlets.index', compact('hamlets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.hamlets.create-hamlet');
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
            'hamlet_name' => 'required'
        ]);

        Hamlet::create([
            'hamlet_name' => $request->hamlet_name
        ]);
        
        return redirect()->route('hamlets.index')->with('success', 'Data berhasil disimpan.');
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
        $hamlet = Hamlet::find($id);
        return view('admin.hamlets.edit-hamlet', compact('hamlet'));
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
        // dd($request->all());
        $this->validate($request, [
            'hamlet_name' => 'required',
        ]);

        $edit = Hamlet::find($id);
        $edit->hamlet_name = $request->hamlet_name;
        $edit->save();
        
        return redirect()->route('hamlets.index')->with('success', 'Data berhasil disimpan.');
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
        $hamlet = Hamlet::find($id);
        $hamlet->delete();
        return redirect()->route('hamlets.index')->with('success', 'Data berhasil disimpan.');;
    }
}
