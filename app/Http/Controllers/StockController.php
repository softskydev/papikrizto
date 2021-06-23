<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductStock;
use App\Stock;
use App\StockHistory;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
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
        $stock['data'] = Stock::join('products', 'products.id', '=', 'stocks.product_id')
                            ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                            ->select('stocks.*', DB::raw('products.name AS product'), DB::raw('product_stocks.nama_stock AS product_stock'))->get();
        return view('stocks.index' , $stock);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stock['product_data'] = Product::all();
        $stock['product_stock_data'] = ProductStock::all();
        
        return view('stocks.create', $stock);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock = new Stock;
        $stock->product_id = $request->product_id;
        $stock->product_stock_id = $request->product_stock_id;
        $stock->price = $request->price;
        $stock->stock = $request->stock;
        $stock->save();

        $stock_history = new StockHistory;
        $stock_history->stock_id = $stock->id;
        $stock_history->status = 'masuk';
        $stock_history->quantity = $request->stock;
        $stock_history->save();

        $status = [
            'status' => 'success',
            'msg' => 'Data berhasil di simpan'
        ];

        return redirect()->route('stock.index')->with( $status );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock['detail'] = Stock::join('products', 'products.id', '=', 'stocks.product_id')
                            ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                            ->select('stocks.*', DB::raw('products.name AS product'), DB::raw('product_stocks.nama_stock AS product_stock'))->where("stocks.id", $id)->first();

        $stock['product_data'] = Product::all();
        $stock['product_stock_data'] = ProductStock::all();

        return view('stocks.edit', $stock);
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
        $stock = Stock::find($id);
        $stock->product_id = $request->product_id;
        $stock->product_stock_id = $request->product_stock_id;
        $stock->price = $request->price;
        $stock->stock = $request->stock;
        $stock->save();

        StockHistory::where('stock_id', $id)->first()->delete();

        $stock_history = new StockHistory;
        $stock_history->stock_id = $stock->id;
        $stock_history->status = 'masuk';
        $stock_history->quantity = $request->stock;
        $stock_history->save();

        $status = [
            'status' => 'info',
            'msg' => 'Data berhasil di update'
        ];

        return redirect()->route('stock.index')->with( $status );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stock::findOrFail($id)->delete();
        
        $status = [
            'status' => 'danger',
            'msg' => 'Data berhasil di hapus'
        ];

        echo json_encode($status);
    }
}
