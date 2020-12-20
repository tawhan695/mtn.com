<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\products;
use Illuminate\Support\Facades\Auth;
class TypeProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // if(!session()->has('branch')){
        //     // session()->put('branch',Auth::user()->user_branch_id());
        //     var_dump(Auth::user());
        // }
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
        
        $products = products::where('branch_id',Auth::user()->user_branch_id())->get();
        return view('admin.products.typeProduct.index')->with(['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.typeProduct.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('Manager')){
            return view('admin.dashdorad.index');
        }
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png',
            'name' => 'required|max:255',    
            'retail' => 'required|numeric',
            'wholesale' => 'required|numeric',
            'des' => 'max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }
        // var_dump($request->image->store('images/img_product'));
        $tableTypeProduct = new products;
        if($request->image){
            $tableTypeProduct->image = $request->image->store('images','public');
        }else
        {
            $tableTypeProduct->image ='images/WviODx1U4Ux6Fh1bfqIdIuH4apsCYjZivAQNBl3f.jpeg';
        }
        $tableTypeProduct->name = $request->name;
        $tableTypeProduct->retail = $request->retail;
        $tableTypeProduct->wholesale = $request->wholesale;
        $tableTypeProduct->branch_id = Auth::user()->user_branch_id();
        
        if($request->des){
            $tableTypeProduct->des = $request->des;
        }
        $tableTypeProduct->save();
        $products = products::all();
        return redirect(route('admin.TypeProducts.index'))->with(['products'=>$products]);
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
    public function edit(products $products)
    {
 
    //    var_dump($products->first());
       return view('admin.products.typeProduct.edit')->with(['product'=>$products->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        if (Gate::denies('Manager')){
            return view('admin.dashdorad.index');
        }
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png',
            'name' => 'required|max:255',    
            'retail' => 'required|numeric',
            'wholesale' => 'required|numeric',
            'des' => 'max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }
        $tableTypeProduct =  products::find($id);
        if($request->image){
            $tableTypeProduct->image = $request->image->store('images','public');
        }
        $tableTypeProduct->name = $request->name;
        $tableTypeProduct->retail = $request->retail;
        $tableTypeProduct->wholesale = $request->wholesale;
        // if($request->des){
            $tableTypeProduct->des = $request->des;
        // }
        $tableTypeProduct->update();
        
        return redirect(route('admin.TypeProducts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('Manager')){
            return view('admin.dashdorad.index');
        }

        $image = products::find($id)->first()->image;
        // $sa =unlink('storage/'.$image);
        $del = products::find($id)->delete();

        Alert::alert('แจ้งเตือน', 'ลบข้อมูลสำเร็จ', 'Type');
        return redirect(route('admin.TypeProducts.index'));
        if($del){
            
        }else{
            Alert::alert('แจ้งเตือน', 'ลบข้อมูลไม่สำเร็จ', 'Type');
            return redirect(route('admin.TypeProducts.index'));

        }
    }
}
