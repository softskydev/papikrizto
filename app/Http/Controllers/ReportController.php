<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\Asset;
use App\Account;
use App\HutangPiutang;

class ReportController extends Controller
{
    public function labarugi(){
    	$report['penjualan'] = Transaction::select(DB::raw('SUM(total) AS total'))->first()->total;
    	return view('report/labarugi', $report);
    }
    public function neraca(){
    	$report['asset'] = Asset::all();
    	$report['kas'] = Account::select(DB::raw('SUM(saldo) AS total'))->first()->total;
    	$report['hutang'] = HutangPiutang::where('type', 'Hutang')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
    	$report['piutang'] = HutangPiutang::where('type', 'Piutang')->select(DB::raw('SUM(nominal) AS total'))->first()->total;
    	return view('report/neraca', $report);
    }
}
