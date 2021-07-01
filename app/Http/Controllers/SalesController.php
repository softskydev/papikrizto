<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Branch;
use App\Product;
use Str;

class SalesController extends Controller
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
        $sales['data'] = Sales::all();
        $sales['branch'] = Branch::all();
        return view('sales.index' , $sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sales['product_data'] = Product::all();
        $sales['branch'] = Branch::all();

        return view('sales.create', $sales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('ktp');
        $fileName = date('YmdHis').'_'.Str::slug($request->name).".jpg";

        $target = 'ktp';
        $file->move($target,$fileName);
        
        $sales = new Sales;
        $sales->name = $request->name;
        $sales->email = $request->email;
        $sales->phone = $request->phone;
        $sales->gender = $request->gender;
        $sales->ktp = $fileName;
        $sales->branch_id = $request->branch_id;
        $sales->status = "aktif";
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
        $sales['detail'] = Sales::find($id);
        $sales['branch'] = Branch::all();
        return view('sales.edit' , $sales);
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
        if ($request->ktp != null) {
            $file = $request->file('ktp');
            $fileName = date('YmdHis').'_'.Str::slug($request->name).".jpg";

            $target = 'ktp';
            $file->move($target,$fileName);
        }else{
            $fileName = Sales::where('id', $id)->first()->ktp;
        }  

        $sales = Sales::find($id);
        $sales->name = $request->name;
        $sales->email = $request->email;
        $sales->phone = $request->phone;
        $sales->gender = $request->gender;
        $sales->ktp = $fileName;
        $sales->branch_id = $request->branch_id;
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
        // Sales::findOrFail($id)->delete();
        
        // $status = [
        //     'status' => 'danger',
        //     'msg' => 'Data berhasil di hapus'
        // ];

        // echo json_encode($status);
    }

    public function set_status($id, $status){
        $sales = Sales::find($id);
        $sales->status = $status;
        $sales->save();

        $msg = ($status=="aktif"?"diaktifkan kembali":"dinonaktifkan");

        $status = [
            'status' => 'info',
            'msg' => 'Sales telah '.$msg
        ];

        return redirect()->route('sales.index')->with( $status );
    }
}
