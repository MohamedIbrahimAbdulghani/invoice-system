<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    function __construct()
    {
        // this is to protected roles permissions
        $this->middleware('permission:المستخدمين', ['only' => ['index']]);
        $this->middleware('permission:اضافة مستخدم', ['only' => 'create','store']);
        $this->middleware('permission:تعديل مستخدم', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف مستخدم', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.show_user',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create_user', compact('roles'));
    }

    public function store(Request $request)
    {
        // return $request;
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'roles_name' => 'required'
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles_name'));
        return redirect()->route('users.index')
        ->with('success','تم اضافة المستخدم بنجاح');
    }

    public function show()
    {

    }

    public function edit(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit_user', compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required',
            'roles_name' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles_name'));
        return redirect()->route('users.index')
        ->with('success','تم تحديث معلومات المستخدم بنجاح');
    }

    public function destroy(Request $request)
    {
        User::find($request->user_id)->delete();
        return redirect()->route('users.index')->with('success','تم حذف المستخدم بنجاح');
    }
}
