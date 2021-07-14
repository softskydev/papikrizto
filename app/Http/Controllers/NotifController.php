<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockRequest;
use App\Notification;
use Illuminate\Support\Facades\DB;
use PDO;
use Session;

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

        $count_unread = StockRequest::where('seen' , 0)->count();

        $string = '';
        foreach($req as $notif){
                    $string .= "<li id='notif_other_branch'>";
					$string .= "<a href='".route('request.show', $notif->id)."'>";
					$string .= "<span class='avatar bg-primary'><i class='menu-icon ti-package'></i></span>";
					$string .= "<span class='name'>$notif->branch</span>";
					$string .= "<span class='desc'>Request : $notif->variant ($notif->stock $notif->satuan)</span>";
					$string .= "</a>";
					$string .= "</li>";
        }

        return response()->json(['status'=>200,'data'=>$string,'new_request' => $count_unread]);

    }

    function load_notif(){
        $branch_id    = Session::get('branch_id');
        $notification = Notification::where('branch_id' , $branch_id)->orderBy('id', 'DESC')->get();
        $notif_unread = Notification::where('seen' , 0)->where('branch_id' , $branch_id)->count();

        $string = '';
        foreach ($notification as $key ) {
            $string .= "<li id='notif_other_branch'>";
            $string .= "<a href='".$key->routes.$key->source_id."'>";
            $string .= "<span class='avatar bg-primary'><i class='menu-icon ti-package'></i></span>";
            $string .= "<span class='name'>$key->subtitle</span>";
            $string .= "<span class='desc'>$key->title</span>";
            $string .= "</a>";
            $string .= "</li>";
        }

        return response()->json(['status' => 200 , 'data' => $string , 'new_notif' => $notif_unread ]);



    }

    function update_seen(Request $request){

       
        if ($request['request'] == 'request') {
            $as = 1;
            StockRequest::where('seen' , '=' , 0)->update(['seen' => 1]);
        } else {
            $as = 2;
            Notification::where('seen' , '=' , 0)->update(['seen' => 1]);
        }

        return response()->json(['status' => 200 , 'msg'=>'success' , 'as' => $as]);
    }
}
