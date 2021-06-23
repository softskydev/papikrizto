<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductStock;

class ProductStockController extends Controller
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
        $table    = 'product_stocks as stock_new';
        $column_a = 'stock_new.id';
        $column_b = 'product_stocks.stock_id';
        

        $product['data'] = ProductStock::leftJoin($table,$column_a,$column_b)
                                       ->select('product_stocks.*','stock_new.nama_stock as satuan')
                                       ->get();        
        return view('product_stock.index' , $product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $product['current_stock'] = ProductStock::all();
        return view('product_stock.create' , $product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new ProductStock();
        $product->nama_stock = $request->nama_stock;
        $product->stock_id   = ($request->satuan_id) ? $request->satuan_id : 0;
        $product->peritem    = ($request->per_stock) ? $request->per_stock : 0;
        $product->save();

        $status = [
            'status' => 'success',
            'msg' => 'Data berhasil di simpan'
        ];

        return redirect()->route('product_stock.index')->with( $status );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product['detail'] = ProductStock::find($id);
        $product['current_stock'] = ProductStock::all();
        return view('product_stock.edit' , $product);
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
        //
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
