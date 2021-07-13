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
use PDF;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('admin-middleware');
    }
    public function stock(){
        $report['stock'] = Stock::join('product_variants', 'product_variants.id', '=', 'stocks.variant_id')
                    ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                    ->select('stocks.*', DB::raw('product_variants.variant_name AS variant'), DB::raw('product_variants.branch_id AS branch_id'), 'product_variants.product_code', 'product_stocks.nama_stock', DB::raw('SUM(stocks.stock) AS stock'))
                    ->where('stocks.stock', '>', 0)
                    ->groupBy('stocks.id')
                    ->orderBy('product_variants.product_code')
                    ->get();
        $report['branch'] = Branch::all();
        return view('report/stock', $report);
    }
    public function stock_print($id){
        $report['stock'] = Stock::join('product_variants', 'product_variants.id', '=', 'stocks.variant_id')
                    ->join('product_stocks', 'product_stocks.id', '=', 'stocks.product_stock_id')
                    ->select('stocks.*', DB::raw('product_variants.variant_name AS variant'), DB::raw('product_variants.branch_id AS branch_id'), 'product_variants.product_code', 'product_stocks.nama_stock', DB::raw('SUM(stocks.stock) AS stock'))
                    ->where([
                        ['stocks.stock', '>', 0],
                        ['product_variants.branch_id', '=', $id]
                    ])
                    ->groupBy('stocks.id')
                    ->orderBy('product_variants.product_code')
                    ->get();
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
