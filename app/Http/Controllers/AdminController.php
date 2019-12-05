<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $users = User::orderBy('id')->get();
        return view('admin.index',['users'=>$users]);
    }

    public function create(){
        return view('admin.create');
    }

    public function store(Request $request)
    {
        //Persist the employee in the database
        //form data is available in the request object
        $user = new User();
        //input method is used to get the value of input with its
        //name specified
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $temppassword = $request->input('password');
        $user->password = Hash::make($temppassword);
        $user->role = $request->input('role');
        $user->save(); //persist the data
        return redirect()->route('admin.index')->with('info', 'User Added Successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit',['user'=>$user]);
    }

    public function update(Request $request)
    {
        //Retrieve the employee and update
        $user = User::findOrFail($request->input('id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $temppassword = $request->input('password');
        $user->password = Hash::make($temppassword);
        $user->role = $request->input('role');
        $user->save(); //persist the data
        return redirect()->route('admin.index')->with('info','User Updated Successfully');
    }

    public function search(Request $request){
        $search =$request->get('search');
        $users = DB::table('users')->where('name','like','%'.$search.'%')->get();


        return view('admin.index',['users'=>$users]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.index');
    }
}
