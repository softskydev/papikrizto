<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\Product;
use App\Branch;
use App\TransactionItem;
use App\Stock;
use App\StockHistory;
use App\ProductStock;

class TransactionController extends Controller
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
        $transaction['data'] = Transaction::join('branches', 'transactions.branch_id', '=', 'branches.id')->select('transactions.*', 'branches.name')->get();
        return view('transaction.index', $transaction);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastOrder = Transaction::orderBy('transaction_no', 'DESC')->get();
        if (count($lastOrder) == 0) {
            $transaction['transaction_no'] = "0001";
        }else{
            $tmp = explode('SO/', $lastOrder[0]->transaction_no);
            $newOrder = $tmp[1]+1;
            if ($newOrder < 10) {
                $transaction['transaction_no'] = "000".$newOrder;
            }elseif($newOrder >= 10 && $newOrder < 100){
                $transaction['transaction_no'] = "00".$newOrder;
            }elseif($newOrder >= 100 && $newOrder < 1000){
                $transaction['transaction_no'] = "0".$newOrder;
            }else{
                $transaction['transaction_no'] = $newOrder;
            }
        }
        $transaction['product'] = Product::all();
        $transaction['stock'] = Stock::join('product_stocks', 'stocks.product_stock_id', '=', 'product_stocks.id')
            ->select('stocks.*', 'product_stocks.nama_stock')->get();
        $transaction['branch'] = Branch::all();
        return view ('transaction.create', $transaction);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = new Transaction;
        $transaction->transaction_no = "SO/".$request->transaction_no;
        $transaction->branch_id = $request->branch_id;
        $transaction->total = $request->total;
        $transaction->date = $request->date;
        $transaction->save();

        for ($i=1; $i < $request->count; $i++) { 
            if ($request['product_id'.$i] != 0) {
                $item = new TransactionItem;
                $item->transaction_id = $transaction->id;
                $item->product_id = $request['product_id'.$i];
                $item->quantity = $request['quantity'.$i];
                $item->total = $request['hidden_total'.$i];
                $item->stock_id = $request['stock_id'.$i];
                $item->save();

                $stock_history = new StockHistory;
                $stock_history->stock_id = $request['stock_id'.$i];
                $stock_history->status = 'keluar';
                $stock_history->quantity = $request['quantity'.$i];
                $stock_history->save();

                $stock = Stock::find($request['stock_id'.$i]);
                $stock->stock -= $request['quantity'.$i];
                $stock->save();
            }
        }

        $status = [
            'status' => 'success',
            'msg' => 'Data berhasil di simpan'
        ];

        return redirect()->route('transaction.index')->with( $status );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction['detail'] = Transaction::join('branches', 'branches.id', '=', 'transactions.branch_id')->where('transactions.id', $id)->select('transactions.*', DB::raw('branches.name AS branch'))->first();
        $transaction['item'] = TransactionItem::join('products', 'products.id', '=', 'transaction_items.product_id')
                                ->join('stocks', 'stocks.product_id', '=', 'products.id')
                                ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                                ->where('transaction_id', $id)->select('products.*', 'transaction_items.*', 'product_stocks.*')->get();

        return view('transaction.show', $transaction);
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
        // $item = TransactionItem::where('transaction_id', $id)->get();

        // foreach ($item as $i) {
        //     $s = Stock::where('id', $i->stock_id)->get();

        //     $stock = new Stock;
        //     $stock->stock = $s->stock + $i->quantity;
        // }

        // // Transaction::findOrFail($id)->delete();
        
        // $status = [
        //     'status' => 'danger',
        //     'msg' => 'Data berhasil di hapus'
        // ];

        // echo json_encode($status);
    }

    public function json_price($stock_id){
        $price = Stock::where('id', $stock_id)->first()->price;

        echo json_encode($price);
    }
    public function json_stock($product_id){
        $stock = Stock::join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')->where('product_id', $product_id)->select('stocks.*', 'product_stocks.nama_stock')->get();

        echo json_encode($stock);
    }
    public function json_product()   {
        $product = Product::all();

        echo json_encode($product);
    }
}