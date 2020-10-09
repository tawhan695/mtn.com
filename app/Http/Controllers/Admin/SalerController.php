<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Saler;
use Illuminate\Http\Request;
use App\User;
use App\products;
use Illuminate\Support\Facades\Auth;

class SalerController extends Controller
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
      
        $products = products::where('branch_id',Auth::user()->user_branch_id())->get();

        return view('admin.sales.menu')->with(['products'=>$products]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    //    var_dump($request->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(!session()->has('branch')){
        //     session()->put('branch',Auth::user()->user_branch_id());
        // }

        $products = products::where('id',$request->id)->get();
       return response()->json($products[0]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Saler  $saler
     * @return \Illuminate\Http\Response
     */
    public function show( $type)
    {
  
    $products = products::where('branch_id',Auth::user()->user_branch_id())->get();
    return view('admin.sales.index')->with(['products'=>$products,'type'=>$type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Saler  $saler
     * @return \Illuminate\Http\Response
     */
    public function edit(Saler $saler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Saler  $saler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saler $saler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Saler  $saler
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saler $saler)
    {
        //
    }
  
}
