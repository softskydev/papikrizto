<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductVariant;
use App\Branch;
use App\Stock;
use App\ProductStock;

class ProductVariantController extends Controller
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
        $variant['data'] = ProductVariant::all();
        $variant['branch'] = Branch::all();

        return view('variant.index' , $variant);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $variant['branch'] = Branch::all();
        $variant['product_stock'] = ProductStock::all();
        return view('variant.create' , $variant);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $variant = new ProductVariant;
        $variant->branch_id = $request->branch_id;
        $variant->product_code = $request->product_code;
        $variant->variant_name = $request->variant_name;
        $variant->save();

        $stock = new Stock;
        $stock->variant_id = $variant->id;
        $stock->branch_id = $request->branch_id;
        $stock->product_stock_id = 1;
        $stock->price = 0;
        $stock->stock = 0;
        $stock->real_stock = 0;
        $stock->minimum_stock = 0;
        $stock->save();

        $status = [
            'status' => 'info',
            'msg' => 'Data berhasil di update'
        ];

        return redirect()->route('variant.index')->with( $status );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $variant['detail'] = ProductVariant::where('id', $id)->first();
        $variant['branch'] = Branch::all();
        $variant['product_stock'] = ProductStock::all();
        return view('variant.edit' , $variant);
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
        $variant = ProductVariant::find($id);
        $variant->branch_id = $request->branch_id;
        $variant->product_code = $request->product_code;
        $variant->variant_name = $request->variant_name;
        $variant->save();

        $status = [
            'status' => 'info',
            'msg' => 'Data berhasil di update'
        ];

        return redirect()->route('variant.index')->with( $status );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductVariant::findOrFail($id)->delete();
        
        $status = [
            'status' => 'danger',
            'msg' => 'Data berhasil di hapus'
        ];

        echo json_encode($status);
    }

    public function set_status($id, $status){
        $variant = ProductVariant::find($id);
        $variant->status = $status;
        $variant->save();

        $msg = ($status=="aktif"?"diaktifkan kembali":"dinonaktifkan");

        $status = [
            'status' => 'info',
            'msg' => 'Varian produk telah '.$msg
        ];

        return redirect()->route('variant.index')->with( $status );
    }
}
