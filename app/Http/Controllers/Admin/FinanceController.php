<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\finance;
use App\Saler;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\order_list;
use Illuminate\Support\Facades\Auth;
class FinanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        try {
          $finance = finance::where('branch_id',Auth::user()->user_branch_id())->first()->wallet;
        } catch (\Throwable $th) {
            $finance = 0;
        }

        return view('admin.finance.index')->with(
            [
                'finance'=>$finance,
                'tatol_price'=>Saler::where('branch_id',Auth::user()->user_branch_id())->where('created_at','>=',Carbon::today())->get(),
                'qty'=> order_list::where('branch_id',Auth::user()->user_branch_id())->where('created_at','>=',Carbon::today())->get(),
                'tatol_p'=>Saler::where('branch_id',Auth::user()->user_branch_id())->get(),
                'total_qty'=> order_list::where('branch_id',Auth::user()->user_branch_id())->get()
            ]);
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
        // var_dump($request->all());
        $finance = finance::find($id);
        if(!$finance){
            $F = new finance;
            $F->wallet = $request->price_update;
            $F->branch_id = $request->Auth::user()->user_branch_id();
            $F->save();
        }else{
            $finance->wallet = $finance->wallet + $request->price_update;
            $finance->update();
        }
        return redirect(route('admin.finance.index'));
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
