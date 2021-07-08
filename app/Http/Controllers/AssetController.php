<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;

class AssetController extends Controller
{
    public function __construct(){
        $this->middleware('admin-middleware');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asset['data'] = Asset::all();

        return view('asset.index' , $asset);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('asset.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asset = new asset;
        $asset->name = $request->name;
        $asset->quantity = $request->quantity;
        $asset->price = $request->price;
        $asset->save();

        $status = [
            'status' => 'success',
            'msg' => 'Data berhasil di simpan'
        ];

        return redirect()->route('asset.index')->with( $status );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset = Asset::find($id);
        return view('asset.edit' , ['detail'=> $asset]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $asset = Asset::find($id);
        $asset->name = $request->name;
        $asset->quantity = $request->quantity;
        $asset->price = $request->price;
        $asset->save();

        $status = [
            'status' => 'info',
            'msg' => 'Data berhasil di update'
        ];

        return redirect()->route('asset.index')->with( $status );
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
    }
}
