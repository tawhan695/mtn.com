<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\products;
use App\DefectiveProducts;
class DefectiveProductsController extends Controller
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
        $DefectiveProducts = DefectiveProducts::where('branch_id',Auth::user()->user_branch_id())->orderBy('id', 'DESC')->get();
        return view('admin.products.defectiveproducts.index')
                ->with([
                    'products'=>$products,
                    'DefectiveProducts'=>$DefectiveProducts
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
        // var_dump($request->all());
        $products = products::find($request->product_id);
        if($products->qty > 0 ){
            $products->qty = $products->qty - $request->qty;
            $products->update();
            // var_dump($products->id);
            $DefectiveProducts = new DefectiveProducts;
            $DefectiveProducts->products_id=$products->id;
            $DefectiveProducts->image=$products->image;
            $DefectiveProducts->name=$products->name;
            $DefectiveProducts->retail=$products->retail;
            $DefectiveProducts->wholesale=$products->wholesale;
            $DefectiveProducts->qty=$request->qty;
            $DefectiveProducts->branch_id=$products->branch_id;
            $DefectiveProducts->save();
            return redirect(route('admin.DefectiveProducts.index'));
        }else{
            redirect()->route('admin.DefectiveProducts.index')->withErrors(['productnull'=>'สินค้าไม่มี']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
