<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;

class AdminFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $fields = Field::all();
        return view('admin.fields.index', compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fields.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'price_per_hour' => 'required|numeric',
        ]);
        Field::create($request->only('name', 'address', 'price_per_hour'));
        return redirect()->route('admin.fields.index')->with('success', 'Thêm sân thành công!');
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
        $field = Field::findOrFail($id);
        return view('admin.fields.edit', compact('field'));
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
        $field = Field::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'price_per_hour' => 'required|numeric',
            'image' => 'nullable|string|max:255', // Optional image validation
            'type' => 'required',
        ]);
        $field->update($request->only('name', 'address', 'price_per_hour' , 'image', 'type'));
        return redirect()->route('admin.fields.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Field::destroy($id);
        return redirect()->route('admin.fields.index')->with('success', 'Xóa thành công!');
    }
}
