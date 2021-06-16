<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Product;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $branch['product_id'] = $id;
        return view('branch.create', $branch);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $branch = new Branch;
        $branch->name = $request->name;
        $branch->username = $request->username;
        $branch->password = md5($request->password);
        $branch->product_id = $request->product_id;
        $branch->save();

        $status = [
            'status' => 'success',
            'msg' => 'Data berhasil di simpan'
        ];

        return redirect()->route('branch.show', $request->product_id)->with( $status );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch['product'] = Product::where('id', $id)->first()->name;
        $branch['product_id'] = Product::where('id', $id)->first()->id;
        $branch['data'] = Branch::where('product_id', $id)->get();
        
        return view('branch.show' , $branch);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch['detail'] = Branch::find($id);
        $branch['product_id'] = Branch::where('id', $id)->first()->product_id;
        return view('branch.edit' , $branch);
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
        $branch = Branch::find($id);
        $branch->name = $request->name;
        $branch->username = $request->username;
        // if($request->password != "") $branch->password = md5($request->password);
        $branch->save();

        $status = [
            'status' => 'info',
            'msg' => 'Data berhasil di update'
        ];

        return redirect()->route('branch.show', $request->product_id)->with( $status );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::findOrFail($id)->delete();
        
        $status = [
            'status' => 'danger',
            'msg' => 'Data berhasil di hapus'
        ];

        echo json_encode($status);
    }
}
