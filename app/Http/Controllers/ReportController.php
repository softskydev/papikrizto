<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\Asset;
use App\Account;
use App\HutangPiutang;
use App\Stock;
use App\Branch;
use App\StockHistories;
use PDF;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('admin-middleware');
    }
    public function stock(Request $request){
        if ($request->method() == 'GET') {
            $report['start'] = 0;
            $report['end'] = 0;

            $report['stock'] = StockHistories::join('stocks', 'stocks.id', '=', 'stock_histories.stock_id')
                        ->join('product_variants', 'product_variants.id', '=', 'stocks.variant_id')
                        ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                        ->select('stock_histories.created_at', 'product_variants.product_code', 'product_variants.variant_name', 'stock_histories.quantity', 'stock_histories.status', 'product_stocks.nama_stock', 'product_variants.branch_id')
                        ->orderBy('stock_histories.created_at', 'asc')
                        ->get();
        }else{
            $report['start'] = $request->start;
            $report['end'] = $request->end;
            $report['stock'] = StockHistories::join('stocks', 'stocks.id', '=', 'stock_histories.stock_id')
                        ->join('product_variants', 'product_variants.id', '=', 'stocks.variant_id')
                        ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                        ->where([
                            ['stock_histories.created_at', '>=', $request->start],
                            ['stock_histories.created_at', '<=', $request->end]
                        ])
                        ->select('stock_histories.created_at', 'product_variants.product_code', 'product_variants.variant_name', 'stock_histories.quantity', 'stock_histories.status', 'product_stocks.nama_stock', 'product_variants.branch_id')
                        ->orderBy('stock_histories.created_at', 'asc')
                        ->get();

        }

        $report['branch'] = Branch::all();
        return view('report/stock', $report);
    }
    public function stock_print($id, $start, $end){
        if ($start == 0 || $end == 0) {
            $report['start'] = 0;
            $report['end'] = 0;

            $report['stock'] = StockHistories::join('stocks', 'stocks.id', '=', 'stock_histories.stock_id')
                        ->join('product_variants', 'product_variants.id', '=', 'stocks.variant_id')
                        ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                        ->where('product_variants.branch_id', $id)
                        ->select('stock_histories.created_at', 'product_variants.product_code', 'product_variants.variant_name', 'stock_histories.quantity', 'stock_histories.status', 'product_stocks.nama_stock', 'product_variants.branch_id')
                        ->orderBy('stock_histories.created_at', 'asc')
                        ->get();
        }else{
            $report['start'] = $start;
            $report['end'] = $end;
            $report['stock'] = StockHistories::join('stocks', 'stocks.id', '=', 'stock_histories.stock_id')
                        ->join('product_variants', 'product_variants.id', '=', 'stocks.variant_id')
                        ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                        ->where([
                            ['product_variants.branch_id', '=', $id],
                            ['stock_histories.created_at', '>=', $start],
                            ['stock_histories.created_at', '<=', $end]
                        ])
                        ->select('stock_histories.created_at', 'product_variants.product_code', 'product_variants.variant_name', 'stock_histories.quantity', 'stock_histories.status', 'product_stocks.nama_stock', 'product_variants.branch_id')
                        ->orderBy('stock_histories.created_at', 'asc')
                        ->get();
        }

        $report['branch'] = Branch::where('id', $id)->first()->name;

        $pdf = PDF::loadview('report/stock_pdf',$report)->setPaper('A4', 'potrait');
        return $pdf->stream("STOCK_".$report['branch'].".pdf");
    }
    public function labarugi(){
        $report['penjualan'] =  [];
        $report['branch'] = Branch::all();
        foreach ($report['branch'] as $b) {
            $report['penjualan'][$b->id] = Transaction::select(DB::raw('SUM(total) AS total'))
                                ->where('branch_id', $b->id)
                                ->first()->total;
            if ($report['penjualan'][$b->id] == null) {
                $report['penjualan'][$b->id] = 0;
            }
        }

    	return view('report/labarugi', $report);
    }
    public function labarugi_print($id, Request $request){
        $report['penjualan'] = Transaction::select(DB::raw('SUM(total) AS total'))
                                ->where('branch_id', $id)
                                ->first()->total;
        $report['branch'] = Branch::where('id', $id)->first()->name;
        $report['pendapatanlain'] = $request->pendapatanlain;
        $report['biaya'] = $request->biaya;
        $report['interest'] = $request->interest;
        $report['tax'] = $request->tax;

        $pdf = PDF::loadview('report/labarugi_pdf',$report)->setPaper('A4', 'potrait');
        return $pdf->stream("LABARUGI_".$report['branch'].".pdf");
    }
    public function neraca(){
    	$report['asset'] = Asset::all();
    	$report['kas'] = Account::select(DB::raw('SUM(saldo) AS total'))->first()->total;
        $report['stock'] = Stock::select(DB::raw('SUM(price*stock) AS stock'))->first()->stock;
    	$report['hutang'] = HutangPiutang::where('type', 'Hutang')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
        $report['hutang_bank'] = HutangPiutang::where('category', 'Hutang Bank')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
        $report['hutang_pihak_ketiga'] = HutangPiutang::where('category', 'Hutang Pihak Ketiga')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
        $report['hutang_pemegang_saham'] = HutangPiutang::where('category', 'Hutang Pemegang Saham')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
    	$report['piutang'] = HutangPiutang::where('type', 'Piutang')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
    	return view('report/neraca', $report);
    }
    public function neraca_print(Request $request){
        $report['asset'] = Asset::all();
        $report['kas'] = Account::select(DB::raw('SUM(saldo) AS total'))->first()->total;
        $report['stock'] = Stock::select(DB::raw('SUM(price*stock) AS stock'))->first()->stock;
        $report['hutang'] = HutangPiutang::where('type', 'Hutang')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
        $report['hutang_bank'] = HutangPiutang::where('category', 'Hutang Bank')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
        $report['hutang_pihak_ketiga'] = HutangPiutang::where('category', 'Hutang Pihak Ketiga')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
        $report['hutang_pemegang_saham'] = HutangPiutang::where('category', 'Hutang Pemegang Saham')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
        $report['piutang'] = HutangPiutang::where('type', 'Piutang')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
        $report['lababerjalan'] = $request->lababerjalan;
        $report['labaditahan'] = $request->labaditahan;
        $report['biaya'] = $request->biaya;

        $pdf = PDF::loadview('report/neraca_pdf',$report)->setPaper('A4', 'potrait');
        return $pdf->stream("NERACA.pdf");
    }
    public function hutang($category, Request $request){
        $tmp = explode("_", $category);
        $ctg = "Hutang ".ucfirst(implode(" ", $tmp));      
        $report['category'] = $ctg;

        if ($request->method() == 'GET') {
            $report['start'] = 0;
            $report['end'] = 0;
            $report['hutang'] = HutangPiutang::where('category', $ctg)->get();
            $report['total'] = HutangPiutang::where('category', $ctg)->select(DB::raw('SUM(nominal) AS total'))->first()->total;
        }else{
            $report['start'] = $request->start;
            $report['end'] = $request->end;
            $report['hutang'] = HutangPiutang::where([
                ['category', '=', $ctg],
                ['date', '>=', $request->start],
                ['date', '<=', $request->end]
            ])->get();
            $report['total'] = HutangPiutang::where([
                ['category', '=', $ctg],
                ['date', '>=', $report['start']],
                ['date', '<=', $report['end']]
            ])->select(DB::raw('SUM(nominal) AS total'))->first()->total;
            
        }
        
        return view('report/hutang', $report);
    }
}
