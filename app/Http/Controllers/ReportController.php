<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\Asset;
use App\Account;
use App\HutangPiutang;
use App\Stock;

class ReportController extends Controller
{
    public function labarugi(){
    	$report['penjualan'] = Transaction::select(DB::raw('SUM(total) AS total'))->first()->total;
    	return view('report/labarugi', $report);
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
