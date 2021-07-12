<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HutangPiutang;

class HutangPiutangController extends Controller
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
        $hutangpiutang['data'] = HutangPiutang::all();

        return view('hutangpiutang.index' , $hutangpiutang);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hutangpiutang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hutangpiutang = new hutangpiutang;
        $hutangpiutang->type = $request->type;
        if($hutangpiutang->type == "Hutang"){
            $hutangpiutang->category = $request->category;
        }else{
            $hutangpiutang->category = "-";
        }
        $hutangpiutang->nominal = $request->nominal;
        $hutangpiutang->date = $request->date;
        $hutangpiutang->note = $request->note;
        $hutangpiutang->save();

        $status = [
            'status' => 'success',
            'msg' => 'Data berhasil di simpan'
        ];

        return redirect()->route('hutangpiutang.index')->with( $status );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hutangpiutang = HutangPiutang::find($id);
        return view('hutangpiutang.edit' , ['detail'=> $hutangpiutang]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $hutangpiutang = HutangPiutang::find($id);
        $hutangpiutang->type = $request->type;
        if($hutangpiutang->type == "Hutang"){
            $hutangpiutang->category = $request->category;
        }else{
            $hutangpiutang->category = "-";
        }
        $hutangpiutang->nominal = $request->nominal;
        $hutangpiutang->date = $request->date;
        $hutangpiutang->note = $request->note;
        $hutangpiutang->save();

        $status = [
            'status' => 'info',
            'msg' => 'Data berhasil di update'
        ];

        return redirect()->route('hutangpiutang.index')->with( $status );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HutangPiutang::findOrFail($id)->delete();
        
        $status = [
            'status' => 'danger',
            'msg' => 'Data berhasil di hapus'
        ];

        echo json_encode($status);
    }
}
