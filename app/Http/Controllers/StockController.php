<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductVariant;
use App\ProductStock;
use App\Stock;
use App\StockHistory;
use App\Branch;
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
        $stock['data'] = Stock::join('product_variants', 'product_variants.id', '=', 'stocks.variant_id')
                    ->select('stocks.*', DB::raw('product_variants.variant_name AS variant'), DB::raw('product_variants.branch_id AS branch_id'), 'product_variants.product_code', DB::raw('SUM(stocks.real_stock) AS total_stock'))->groupBy('stocks.variant_id')->get();
        $stock['branch'] = Branch::all();
        return view('stocks.index' , $stock);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($variant_id)
    {
        $stock['product_stock_data'] = ProductStock::all();
        $stock['variant'] = ProductVariant::where('id', $variant_id)->select('id', 'variant_name')->first();
        
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
        $stock->variant_id = $request->variant_id;
        $stock->product_stock_id = $request->product_stock_id;
        $stock->price = $request->price;
        $stock->stock = $request->stock;

        $product_stock_id = $stock->product_stock_id;
        $ps = ProductStock::where('id', $product_stock_id)->first();
        $parent_id = $ps->stock_id;
        $peritem = $ps->peritem;
        $real_stock = $stock->stock;
        if ($parent_id != 0){
            while ($parent_id > 0) {
                $real_stock *= $peritem;
                $ps = ProductStock::where('id', $parent_id)->first();
                $parent_id = $ps->stock_id;
                $peritem = $ps->peritem;
            }
        }
        $stock->real_stock = $real_stock;
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
        $stock['detail'] = Stock::where('id', $id)->first();
        $branch_id = $stock['detail']->branch_id;

        $stock['product_stock_data'] = ProductStock::all();
        $stock['branch'] = Branch::all();
        $stock['variant'] = ProductVariant::where('id', $stock['detail']->variant_id)->first();

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
        $stock->variant_id = $request->variant_id;
        $stock->product_stock_id = $request->product_stock_id;
        $stock->price = $request->price;
        $stock->stock = $request->stock;

        $product_stock_id = $stock->product_stock_id;
        $ps = ProductStock::where('id', $product_stock_id)->first();
        $parent_id = $ps->stock_id;
        $peritem = $ps->peritem;
        $real_stock = $stock->stock;
        if ($parent_id != 0){
            while ($parent_id > 0) {
                $real_stock *= $peritem;
                $ps = ProductStock::where('id', $parent_id)->first();
                $parent_id = $ps->stock_id;
                $peritem = $ps->peritem;
            }
        }
        $stock->real_stock = $real_stock;

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

    public function detail($variant_id){
        $stock['detail'] = Stock::join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                    ->join('product_variants', 'product_variants.id', '=', 'stocks.variant_id')
                    ->where([
                        ['stocks.variant_id','=', $variant_id],
                        ['stocks.stock', '>', 0]
                    ])
                    ->select('stocks.*', 'product_variants.variant_name AS variant', 'product_stocks.nama_stock AS product_stock', 'product_variants.product_code')
                    ->get();
        return view('stocks.detail', $stock);
    }

    public function json_variant($branch_id){
        $variant = ProductVariant::where('branch_id', $branch_id)->get();

        echo json_encode($variant);
    }
}
