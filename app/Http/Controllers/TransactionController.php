<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\Product;
use App\ProductVariant;
use App\Branch;
use App\TransactionItem;
use App\Stock;
use App\Sales;
use App\Customer;
use App\StockHistory;
use App\ProductStock;
use App\BranchStock;
use App\BranchStockHistory;
use Session;

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
        $transaction['data'] = Transaction::join('branches', 'transactions.branch_id', '=', 'branches.id')->select('transactions.*', 'branches.name')
                            ->join('sales', 'transactions.sales_id', '=', 'sales.id')
                            ->join('customers', 'transactions.customer_id', '=', 'customers.id')
                            ->select('transactions.*', DB::raw('sales.name AS sales'), DB::raw('branches.name AS branch'), DB::raw('customers.name AS customer_name'))
                            ->where('transactions.branch_id', Session::get('branch_id'))->get();
        return view('transaction.index', $transaction);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastOrder = Transaction::where('branch_id', Session::get('branch_id'))->orderBy('transaction_no', 'DESC')->get();
        $transaction['prefix'] = Branch::where('id', Session::get('branch_id'))->first()->prefix;
        if (count($lastOrder) == 0) {
            $transaction['transaction_no'] = "0001";
        }else{
            $tmp = explode($transaction['prefix'], $lastOrder[0]->transaction_no);
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

        $branch_id = Session::get('branch_id');
        $transaction['product'] = ProductVariant::where([
            ['branch_id', $branch_id],
            ['status', 'aktif']
        ])->get();
        $transaction['sales'] = Sales::where([
            ['branch_id', $branch_id],
            ['status', 'aktif']
        ])->get();
        
        // $transaction['stock'] = Stock::join('product_stocks', 'stocks.product_stock_id', '=', 'product_stocks.id')
        //                     ->join('product_variants', 'product_variants.id', '=', 'stocks.variant_id')
        //                     ->where('product_variants.branch_id', $id)
        //                     ->select('stocks.*', 'product_stocks.nama_stock')->get();
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
        $cust_name = $request->customer_name;
        $cust_phone = $request->customer_phone;
        $cust = Customer::where([
            'name' => $cust_name,
            'no_telp' => $cust_phone
        ]);
        if ($cust->count() == 0) {
            $customer = new Customer;
            $customer->name = $cust_name;
            $customer->no_telp = $cust_phone;
            $customer->save();
            $customer_id = $customer->id;
        }else{
            $customer_id = $cust->first()->id;
        }

        $prefix = Branch::where('id', Session::get('branch_id'))->first()->prefix;

        $transaction = new Transaction;
        $transaction->transaction_no = $prefix.$request->transaction_no;
        $transaction->branch_id = $request->branch_id;
        $transaction->total = $request->total;
        $transaction->date = $request->date;
        $transaction->time = $request->time;
        $transaction->customer_id = $customer_id;
        $transaction->sales_id = $request->sales_id;
        $transaction->admin_id = Session::get('id');
        $transaction->branch_id = Session::get('branch_id');
        $transaction->save();

        for ($i=1; $i < $request->count; $i++) { 
            if ($request['variant_id'.$i] != 0) {
                $item = new TransactionItem;
                $item->transaction_id = $transaction->id;
                $item->variant_id = $request['variant_id'.$i];
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

                $product_stock_id = $request['product_stock_id'.$i];
                $ps = ProductStock::where('id', $product_stock_id)->first();
                $parent_id = $ps->stock_id;
                $peritem = $ps->peritem;
                $real_stock = $request['quantity'.$i];
                if ($parent_id != 0){
                    while ($parent_id > 0) {
                        $real_stock *= $peritem;
                        $ps = ProductStock::where('id', $parent_id)->first();
                        $parent_id = $ps->stock_id;
                        $peritem = $ps->peritem;
                    }
                }
                $stock->real_stock -= $real_stock;

                $stock->save();
            }
        }

        $status = [
            'status' => 'success',
            'msg' => 'Data berhasil di simpan'
        ];

        return redirect()->route('transaction.show', $transaction->id)->with( $status );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction['detail'] = Transaction::join('branches', 'branches.id', '=', 'transactions.branch_id')
                        ->join('customers', 'customers.id', '=', 'transactions.customer_id')
                        ->where('transactions.id', $id)
                        ->select('transactions.*', DB::raw('branches.name AS branch'), DB::raw('customers.name AS cust_name'), DB::raw('customers.no_telp AS cust_phone'))
                        ->first();
        $transaction['item'] = TransactionItem::join('product_variants', 'product_variants.id', '=', 'transaction_items.variant_id')
                                ->join('stocks', [
                                    ['stocks.variant_id', '=', 'product_variants.id'],
                                    ['transaction_items.stock_id', '=', 'stocks.id']
                                ])
                                ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                                ->where('transaction_id', $id)->select('product_variants.*', 'transaction_items.*', 'product_stocks.*')->get();

        // echo json_encode($transaction['item']);

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
        $item = TransactionItem::where('transaction_id', $id)->get();

        foreach ($item as $i) {
            $s = Stock::where('id', $i->stock_id)->first();

            $stock = Stock::find($i->stock_id);
            $stock->stock = $s->stock + $i->quantity;
            $stock->save();

            $stock_history = new StockHistory;
            $stock_history->stock_id = $i->stock_id;
            $stock_history->status = 'masuk';
            $stock_history->quantity = $i->quantity;
            $stock_history->save();
        }

        Transaction::findOrFail($id)->delete();
        
        $status = [
            'status' => 'danger',
            'msg' => 'Data berhasil di hapus'
        ];

        echo json_encode($status);
    }

    public function json_price($stock_id){
        $stock['price'] = Stock::where('id', $stock_id)->first()->price;
        $stock['stock'] = Stock::where('id', $stock_id)->first()->stock;

        echo json_encode($stock);
    }
    public function json_stock($variant_id, $product_stock_id){
        $stock = Stock::join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                ->where([
                    ['variant_id', '=', $variant_id],
                    ['product_stock_id', '=', $product_stock_id],
                    ['stocks.stock', '>', 0]
                ])->select('stocks.*', 'product_stocks.nama_stock')->get();

        echo json_encode($stock);
    }
    public function json_product(){
        $branch_id = Session::get('branch_id');
        $product = ProductVariant::where('branch_id', $branch_id)->get();

        echo json_encode($product);
    }
    public function json_product_stock($variant_id){
        $product_stock = Stock::join('product_variants', 'product_variants.id', '=', 'stocks.variant_id')
                        ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                        ->select('product_stocks.*')
                        ->groupBy('product_stocks.id')
                        ->where([
                            ['stocks.variant_id', '=', $variant_id],
                            ['stocks.stock', '>', 0]
                        ])
                        ->get();
        echo json_encode($product_stock);
    }
    public function print(){
        $transaction['detail'] = Transaction::join('branches', 'branches.id', '=', 'transactions.branch_id')
                        ->join('customers', 'customers.id', '=', 'transactions.customer_id')
                        ->where('transactions.id', $id)
                        ->select('transactions.*', DB::raw('branches.name AS branch'), DB::raw('customers.name AS cust_name'), DB::raw('customers.no_telp AS cust_phone'))
                        ->first();
        $transaction['item'] = TransactionItem::join('product_variants', 'product_variants.id', '=', 'transaction_items.variant_id')
                                ->join('stocks', [
                                    ['stocks.variant_id', '=', 'product_variants.id'],
                                    ['transaction_items.stock_id', '=', 'stocks.id']
                                ])
                                ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                                ->where('transaction_id', $id)->select('product_variants.*', 'transaction_items.*', 'product_stocks.*')->get();

        // echo json_encode($transaction['item']);

        return view('transaction.print', $transaction);
    }
}