<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!session()->has('branch')){
            session()->put('branch',Auth::user()->user_branch_id());
        }
        $hasUser = Auth::user()->name;
        $User_image = Auth::user()->image;
        // Gate::denies('Manager');
        // var_dump(Gate::denies('Manager213213'));
        if (Gate::denies('Manager') == false){
             return redirect(route('admin.dashborad.index'));
        }
        else if (Gate::denies('all') == false){
             return redirect(route('admin.StockProducts.index'));
        }
        
        
        else{
            // return view('admin.dashdorad.index',['usermane'=> $hasUser]);

            return view('home',['usermane'=> $hasUser,'User_image'=>$User_image]);
        }
    }
}
