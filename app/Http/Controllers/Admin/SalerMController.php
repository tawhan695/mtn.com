<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Saler;
use App\order_list;
use Illuminate\Http\Request;
use App\products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\finance;
class SalerMController extends Controller
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
        if(!session()->has('branch')){
            session()->put('branch',Auth::user()->user_branch_id());
        }
        $oder = Saler::where('branch_id',session()->get('branch'))->get();

        return view('admin.sales.his')->with(['oder'=>$oder]);
    
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
        // $validator = Validator::make($request->all(), [
        //     'change' => 'required|numeric|min:1|max:5',   
        //     // 'name' => 'required|max:255',   
        //     // 'password' => 'required|max:40',
        //     // 'role' => 'required',
        //     // 'branch' => 'required|max:7',
        //     // 'salary' => 'required|integer|max:1000000', 
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput($request->input());
        // }
        if ($request->change < 0){
            return redirect()->back()->withErrors(['error_change'=>'กรุณาใส่จำนวนเงินที่ต้องจ่าย']);
        }
        
        
        // var_dump($request->all());
    
        
     
        // var_dump($order_list);

        // ["priceSum"]=> string(3) "190" ["discount2"]=> string(1) "0" ["priceall"]=> string(3) "190" ["cash"]=> string(3) "200" ["change"]=> string(2) "10" }

        // echo count($request->id);
        $Saler = new Saler;
        // $Saler->order_lists_id = $request-> ;
        $Saler->user_id =Auth::user()->id ;
        $Saler->branch_id = session()->get('branch') ;
        // $Saler->qty = $request-> ;
        $Saler->total = $request->priceSum ;
        $Saler->discount = $request->discount2 ;
        $Saler->Total_price = $request->priceall ;
        $Saler->change = $request->change ;
        $Saler->cash = $request->cash;
        $Saler->save();
        echo $Saler->id;
        if ($Saler->id){
            $answers = [];
                for ($i=0; $i < count($request->id); $i++) { 
                    # code...
                    // echo $request->id[$i];
                    // echo $request->qty[$i];
                    $products = products::find($request->id[$i]);
                    $products->qty = intval($products->qty) - intval($request->qty[$i]);
                    $products->update();
                    $answers[]=[
                        'products_id'=>$request->id[$i],
                        'qty'=>$request->qty[$i],
                        'price'=>$request->price_pro[$i],
                        'salers_id'=>$Saler->id,
                        "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                        // "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                    ];
                } 
                $order_list  = order_list::insert($answers);
                // $oder = Saler::where('branch_id',session()->get('branch'))->get();
                $finance =  finance::where('branch_id',session()->get('branch'))->first();
                $finance->wallet = $finance->wallet - $request->change; 
                $finance->update();
                return redirect(route('admin.salers.index'));
        }

       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Saler  $saler
     * @return \Illuminate\Http\Response
     */
    public function show(Saler $saler)
    {
        //
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
