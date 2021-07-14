<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockRequest;
use App\ProductStock;
use App\Branch;
use App\ProductVariant;
use App\Stock;
use App\StockHistory;
use App\Notification;
use App\Lib\PusherFactory;
use Illuminate\Support\Facades\DB;


class StockRequestController extends Controller
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
        $req['data'] = StockRequest::join('branches', 'branches.id', '=', 'stock_requests.branch_id')
            ->join('product_variants', 'product_variants.id', '=', 'stock_requests.variant_id')
            ->join('product_stocks', 'product_stocks.id', '=', 'stock_requests.product_stock_id')
            ->select(DB::raw('branches.name AS branch'), DB::raw('product_variants.variant_name AS variant'), DB::raw('product_stocks.nama_stock AS satuan'), 'stock_requests.id', 'stock_requests.stock', 'stock_requests.branch_id')
            ->orderBy('stock_requests.id', 'DESC')->get();
        $req['branch'] = Branch::where('id', '>', 1)->get();

        return view('stock_request.index', $req);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $req['detail'] = StockRequest::where('id', $id)->first();
        $branch_id = $req['detail']->branch_id;

        $stock = Stock::where([
            ['variant_id', '=', $req['detail']->variant_id],
            ['product_stock_id', '=', $req['detail']->product_stock_id],
            ['stock', '>', 0]
        ])->first();

        if ($stock) {
            $req['stock_id'] = $stock->id;
            $req['price'] = $stock->price;
        }else{
            $req['stock_id'] = 0;
            $req['price'] = '';
        }

        $req['product_stock_data'] = ProductStock::all();
        $req['variant'] = ProductVariant::where('id', $req['detail']->variant_id)->first();

        return view('stock_request.edit', $req);
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
        if ($request->stock_id == 0) {
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
        }else{
            $stock = Stock::find($request->stock_id);
            $stock->variant_id = $request->variant_id;
            $stock->product_stock_id = $request->product_stock_id;
            $stock->stock += $request->stock;

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
            $stock->real_stock += $real_stock;

            $stock->save();
        }

        $stock_history = new StockHistory;
        $stock_history->stock_id = $stock->id;
        $stock_history->status = 'masuk';
        $stock_history->quantity = $request->stock;
        $stock_history->save();

        $variant = ProductVariant::where('id', $request->variant_id)->first();

        $notification = new Notification;
        $notification->branch_id = $variant->branch_id;
        $notification->source_id = $variant->id;
        $notification->routes = "/stock/detail/";
        $notification->title = "Stok Diperbarui";
        $notification->subtitle = $variant->variant_name;
        $notification->seen = 0;
        $notification->save();

        PusherFactory::make()->trigger('request', 'item-loaded', ['status' => 200 , 'msg' => 'load_notif' , 'branch_id' => $variant->branch_id ]);

        $status = [
            'status' => 'success',
            'msg' => 'Data berhasil di simpan'
        ];

        StockRequest::where('id', $id)->delete();

        return redirect('stock/detail/'.$request->variant_id)->with( $status );
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
