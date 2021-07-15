<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notification;
use Session;


class DashboardController extends Controller
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
        $session_id = session('branch_id');
        $data = [
            'transactions'      => DB::select('select date ,sum(total) as total_transaction from transactions where branch_id = ? group by date ' , [$session_id] ),
            'total_transactions' => DB::table('transactions')->where('branch_id' , $session_id)
                                                            ->select(DB::raw('sum(total) as total_transction'))
                                                            ->first(),
            'total_customers'   => DB::table('customers')->select(DB::raw('count(*) as total_cust'))
                                                            ->where('branch_id', Session::get('branch_id'))
                                                            ->first(),
            'total_sales'   => DB::table('sales')->select(DB::raw('count(*) as total_sales'))
                                                            ->where('branch_id', Session::get('branch_id'))
                                                            ->first()
        ];

        if (Session::get('branch_id') == 1) {
            $data['latest_transaction'] = Transaction::join("customers", "transactions.customer_id", "=", "customers.id")
                                ->join("branches", "transactions.branch_id", "=", "branches.id")
                                ->select(DB::raw("customers.name AS customer"), "transactions.total", "transactions.date", "transactions.id", DB::raw("branches.name AS branch"))
                                ->orderBy("transactions.date", "desc")
                                ->limit(10)
                                ->get();
        }else{
            $data['latest_transaction'] = Transaction::join("customers", "transactions.customer_id", "=", "customers.id")
                                ->join("branches", "transactions.branch_id", "=", "branches.id")
                                ->where("transactions.branch_id", Session::get('branch_id'))
                                ->select(DB::raw("customers.name AS customer"), "transactions.total", "transactions.date", "transactions.id", DB::raw("branches.name AS branch"))
                                ->orderBy("transactions.date", "desc")
                                ->limit(10)
                                ->get();
        }

        return view('dashboard.index' , $data);
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
        //
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
        //
    }
}
