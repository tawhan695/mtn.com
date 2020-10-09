<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\products;
use App\Branch;
use App\ImportProducts;
use Illuminate\Support\Carbon;
class ChangeProductsController extends Controller
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
        $products_import = ImportProducts::where('form',Branch::find(Auth::user()->user_branch_id())->name)
        ->orderBy('id', 'DESC')->get();
        return view('admin.products.changeproducts.index')
        ->with(['products'=>$products_import,'Branch'=>Branch::all(),'type'=>$products]);
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
        var_dump($request->all());
        $products = products::find($request->product_id);
        $products->qty = $products->qty - $request->qty;
        $products->update();
        $ImportProducts = new ImportProducts;
        $ImportProducts->products_id=$products->id;
        $ImportProducts->image=$products->image;
        $ImportProducts->name=$products->name;
        $ImportProducts->retail=$products->retail;
        $ImportProducts->wholesale=$products->wholesale;
        $ImportProducts->qty=$request->qty;
        $ImportProducts->branch_id=$request->branch;
        $ImportProducts->sent_date=1;
        // $ImportProducts->form=$request->branch;
        $ImportProducts->form=Branch::find(Auth::user()->user_branch_id())->name;
        $ImportProducts->status=false;
        $ImportProducts->sent_date= Carbon::now();
        $ImportProducts->save();
        return redirect(route('admin.ChangeProducts.index'));
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
