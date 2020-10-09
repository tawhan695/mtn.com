<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Branch;
use App\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class EmployeeController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // var_dump($request->id);
        $roles = Role::all();
        $Branch = Branch::find($request->id);
        return view('admin.employee.create')->with(['Branch'=>$Branch,'roles'=>$roles]);
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

        // ["email"]=> string(1) "n" ["password"]=> string(3) "123" ["role"]=> string(1) "2" ["salary"]=> string(3) "123" }
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',   
            'name' => 'required|max:255',   
            'password' => 'required|max:40',
            'role' => 'required',
            'branch' => 'required|max:7',
            'salary' => 'required|integer|max:1000000', 
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }
        // var_dump($request->role);
        try {
            $tableUser = new User;
            $tableUser->name = $request->name;
            $tableUser->email = $request->email.'@mtn.com';
            $tableUser->password = Hash::make($request->password);
            $tableUser->name = $request->name;
           
            $tableUser->save();
            DB::table('role_user');
            $tableUser->roles()->attach($request->role);
            DB::table('branch_user');
            $Branch_1 =Branch::where('name',$request->branch)->first();
            $tableUser->branch()->attach($Branch_1);
            $id = $tableUser->branch()->first()->id;
            $Branch = Branch::find($id);
            $user = Branch::where('id', $id)->first()->users()->get();
            return view('admin.employee.index')
                 ->with(['User'=>$user,'Branch'=>$Branch]);
        } catch (\Throwable $th) {
            return redirect()->back()
            ->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('Manager')){
            return view('admin.dashdorad.index');
        }
        $Branch = Branch::find($id);
        // var_dump($Branch->name);
        $user = Branch::where('id', $id)->first()->users()->get();

        // Alert::alert('Title', 'Message', 'Type');

        return view('admin.employee.index')->with(['User'=>$user,'Branch'=>$Branch]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('Manager')){
            return view('admin.dashdorad.index');
        }
        $User=User::find($id);
        $Branch = Branch::all();

        $Branch_user = User::where('id', $id)->first()->branch()->first()->name;
        $Role = Role::all();
        $Role_user = User::where('id', $id)->first()->roles()->first()->name;

        // var_dump( $Branch_user);
        return view('admin.employee.edit',
                    [
                        'user'=>$User,
                        'Branch'=>$Branch,
                        'Branch_user'=>$Branch_user,
                        'role'=>$Role,
                        'Role_user'=>$Role_user
                    ]);
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (Gate::denies('Manager')){
            return view('admin.dashdorad.index');
        }
        // var_dump($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',   
            'name' => 'required|max:255',   
            // 'password' => 'required|max:40',
            'role' => 'required',
            'branch' => 'required|max:7',
            // 'salary' => 'required|integer|max:1000000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }
        // var_dump($request->role);
        // try {
            $tableUser = User::find($id);
            $tableUser->name = $request->name;
            $tableUser->email = $request->email;
            $tableUser->password = Hash::make($request->password);
            $tableUser->name = $request->name;
           
            $tableUser->update();
            // DB::table('role_user');
            // $tableUser->roles()->attach($request->role);
            // DB::table('branch_user');

            // var_dump($request->all());
            // $user = Branch::where('id', $id)->first()->users()->get();
            // $Branch_1 =r::where('name',$request->branch)->first();
            $tableUser->branch()->sync($request->branch);
            $tableUser->roles()->sync($request->role);
            // $tableUser->branch()->attach($Branch_1);
            // $id = $tableUser->branch()->first()->id;
            $Branch = Branch::find($request->branch);
            // $User = User::find($id);
            $user = Branch::where('id',$request->branch)->first()->users()->get();
            return view('admin.employee.index')
                 ->with(['User'=>$user,'Branch'=>$Branch]);
        // } catch (\Throwable $th) {
        //     return redirect()->back()
        //     ->withInput($request->input());
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::denies('Manager')){
            return view('admin.dashdorad.index');
        }

        $del = User::find($user->first()->id)->delete();
        // var_dump( $del );
        if($del){
            Alert::alert('แจ้งเตือน', 'ปลดพนักงานเรียบร้อย', 'Type');
            return redirect()->back();
            
        }else{
            Alert::alert('แจ้งเตือน', 'ปลดพนักงานไม่สำเร็จ', 'Type');
            return redirect()->back();

        }
        // return redirect()->back();

    }
}
