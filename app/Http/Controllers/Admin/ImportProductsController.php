<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\User;
use App\Branch;
use Illuminate\Http\Request;
use App\products;
use App\ImportProducts;
use Illuminate\Support\Facades\Auth;
class ImportProductsController extends Controller
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
      
        $products_import = ImportProducts::where('status',true) 
            ->where('branch_id',Auth::user()->user_branch_id())
            ->orderBy('id', 'DESC')->get();
        $products_im = ImportProducts::where('status',false)
            ->where('branch_id',Auth::user()->user_branch_id())
            ->orderBy('id', 'DESC')->get();
        // var_dump($products_import);
        $products = products::where('branch_id',Auth::user()->user_branch_id())->get();
        return view('admin.products.importproducts.index')
        ->with(['products'=>$products,'import'=>$products_import,'products_im'=>$products_im]);

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
        
        
        $products = products::find($request->product_id);
        $products->qty = $products->qty + $request->qty;
        $products->update();
        var_dump($products->id);
        $ImportProducts = new ImportProducts;
        $ImportProducts->products_id=$products->id;
        $ImportProducts->image=$products->image;
        $ImportProducts->name=$products->name;
        $ImportProducts->retail=$products->retail;
        $ImportProducts->wholesale=$products->wholesale;
        $ImportProducts->qty=$request->qty;
        $ImportProducts->branch_id=$products->branch_id;
        $ImportProducts->sent_date=1;
        $ImportProducts->form=Branch::find(Auth::user()->user_branch_id())->name;
        $ImportProducts->status=true;
        $ImportProducts->sent_date= Carbon::now();
        $ImportProducts->save();
        return redirect(route('admin.ImportProducts.index'));

                        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return view('admin.products.importproducts.edit')->with(['product'=>ImportProducts::find($id),'Branch'=>Branch::all()]);
    }

  
    public function update(Request $request,$id)
    {
        if($request->name){
            $products->name=$request->name;
            $products->retail=$request->retail;
            $products->wholesale=$request->wholesale;
            $products->qty=$request->qty;
            $products->form=$request->form;
            $products->update();
            return redirect(route('admin.ImportProducts.index'));
            
            // $ImportProducts->form=$request->qty;
        }else{

            // อัพเดทว่ารับสินค้าแลว
            $ImportProducts = ImportProducts::find($id);
            $ImportProducts->status=true;
            $ImportProducts->update();



            // เพิ่มใส่คลังสินค้าสาขา
            // $products = products::find($ImportProducts->products_id);
            $products = products::where('branch_id',Auth::user()->user_branch_id())
            ->where('name',$ImportProducts->name)
            ->first();
            // $products = products::where('name',$ImportProducts->name)->first();
            if($products){
                products::where('name',$ImportProducts->name)->first();
                $products->qty = $products->qty + $request->qty;
                $products->update();
            }else{
                $tableTypeProduct = new products;
                $tableTypeProduct->image = $ImportProducts->image;
                $tableTypeProduct->name = $ImportProducts->name;
                $tableTypeProduct->retail = $ImportProducts->retail;
                $tableTypeProduct->wholesale = $ImportProducts->wholesale;
                $tableTypeProduct->qty = $ImportProducts->qty;
                $tableTypeProduct->branch_id = Auth::user()->user_branch_id();
                $tableTypeProduct->des = $ImportProducts->des;
                $tableTypeProduct->save();
                return redirect(route('admin.ImportProducts.index'));
            }
            // $products->qty = $products->qty + $request->qty;
            // $products->update();
        }
      

      
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
