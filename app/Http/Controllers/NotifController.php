<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockRequest;
use App\Notification;
use Illuminate\Support\Facades\DB;

class NotifController extends Controller
{
    public function load_notif_all()
    {
        $req = StockRequest::join('branches', 'branches.id', '=', 'stock_requests.branch_id')
                    ->join('product_variants', 'product_variants.id', '=', 'stock_requests.variant_id')
                    ->join('product_stocks', 'product_stocks.id', '=', 'stock_requests.product_stock_id')
                    ->select(DB::raw('branches.name AS branch'), DB::raw('product_variants.variant_name AS variant'), DB::raw('product_stocks.nama_stock AS satuan'), 'stock_requests.id', 'stock_requests.stock')
                    ->orderBy('stock_requests.id', 'DESC')->get();
        View::share('req', $req);

        $notification = Notification::orderBy('id', 'DESC')->get();
        View::share('notification', $notification);
    }

    public function load_request(){
        $req = StockRequest::join('branches', 'branches.id', '=', 'stock_requests.branch_id')
                            ->join('product_variants', 'product_variants.id', '=', 'stock_requests.variant_id')
                            ->join('product_stocks', 'product_stocks.id', '=', 'stock_requests.product_stock_id')
                            ->select(DB::raw('branches.name AS branch'), DB::raw('product_variants.variant_name AS variant'), DB::raw('product_stocks.nama_stock AS satuan'), 'stock_requests.id', 'stock_requests.stock')
                            ->orderBy('stock_requests.id', 'DESC')->get();

        $string = '';
        foreach($req as $notif){
                    
					$string .= "<li id='notif_other_branch'>";
					$string .= "<a href='{{route('request.show', $notif->id)}}'>";
					$string .= "<span class='avatar bg-primary'><i class='menu-icon ti-package'></i></span>";
					$string .= "<span class='name'>{{$notif->branch}}</span>";
					$string .= "<span class='desc'>Request : {{$notif->variant}} ({{$notif->stock}} {{$notif->satuan}})</span>";
					$string .= "</a>";
					$string .= "</li>";
        }

        return response()->json(['status'=>200,'data'=>$string]);

    }
}
