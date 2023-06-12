<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); 
    }

    public function users(){
        $users = User::orderBy('id','DESC')->get();
        return view('admin.user.view',compact('users'));
    }

    public function create()
    {
        $user = json_encode(array());
        return view('admin.user.create',compact('user'));
    }
    public function edit(User $user)
    {
        return view('admin.user.create',compact('user'));
    }

    public function store(Request $request)
    {
        if($request->user_id != ''){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'user_type' => 'required',
                'email' => 'required|email|unique:users,email,'.$request->user_id,
                'password' => 'nullable|min:6',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'user_type' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ]);
        }
       
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        if($request->user_id != ''){
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->user_type = $request->user_type;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->is_active = $request->is_active;
            if(isset($request->password)){
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $msg = "User details updated successfully.";
        }else{
            $user = User::create([
                'name' => $request->name,
                'user_type' => $request->user_type,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ]);
            $msg = "User created successfully.";
        }
        return back()->with('status', $msg);
    }

    public function delete(Request $request){
        $user = User::find($request->id);
        $user->is_deleted = 1;
        $user->save();
    }
}
