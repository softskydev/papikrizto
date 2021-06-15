<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales['data'] = Sales::all();
        return view('sales.index' , $sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $sales = new Sales;
        $sales->name = $request->name;
        $sales->birth_day = $request->birth_day;
        $sales->gender = $request->gender;
        $sales->save();

        $status = [
            'status' => 'success',
            'msg' => 'Data berhasil di simpan'
        ];

        return redirect()->route('sales.index')->with( $status );


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sales = Sales::find($id);
        return view('sales.edit' , ['detail'=> $sales]);
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
        $sales = Sales::find($id);
        $sales->name = $request->name;
        $sales->birth_day = $request->birth_day;
        $sales->gender = $request->gender;
        $sales->save();

        $status = [
            'status' => 'info',
            'msg' => 'Data berhasil di update'
        ];

        return redirect()->route('sales.index')->with( $status );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sales::findOrFail($id)->delete();
        
        $status = [
            'status' => 'danger',
            'msg' => 'Data berhasil di hapus'
        ];

        echo json_encode($status);
    }
}
