<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use View;
use Session;
use App\StockRequest;
use App\Notification;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
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
}
