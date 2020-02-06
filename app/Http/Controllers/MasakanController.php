<?php

namespace App\Http\Controllers;

use App\Masakan;
use Illuminate\Http\Request;

class MasakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $masakans = Masakan::where('name','LIKE',"%$search%")->orderBy('id','desc')->paginate(10);
        return view('masakan.index', compact('masakans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('masakan.add');
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
            'harga' => 'required',
            'image' => 'required'
        ]);

        $image = $request->file('image')->storeAs('masakan', $request->name, 'public');

        $masakan = new Masakan;
        $masakan->name = $request->name;
        $masakan->harga = $request->harga;
        $masakan->status = true;
        $masakan->image_name = $request->name;
        $masakan->save();

        session()->flash('success','Sukses tambah masakan!');
        return redirect()->route('masakan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Masakan  $masakan
     * @return \Illuminate\Http\Response
     */
    public function show(Masakan $masakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Masakan  $masakan
     * @return \Illuminate\Http\Response
     */
    public function edit(Masakan $masakan)
    {
        return view('masakan.edit', compact('masakan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Masakan  $masakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masakan $masakan)
    {
        $request->validate([
            'name' => 'required',
            'harga' => 'required',
            'status' => 'required'
        ]);

        
        $masakan->name = $request->name;
        $masakan->harga = $request->harga;
        $masakan->status = true;
        $masakan->save();

        session()->flash('success','Sukses ubah data masakan!');
        return redirect()->route('masakan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Masakan  $masakan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masakan $masakan)
    {
        $masakan->delete();

        session()->flash('success','Sukses hapus masakan!');
        return redirect()->back();
    }
}
