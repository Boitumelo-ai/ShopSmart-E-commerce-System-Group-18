<?php

namespace App\Http\Controllers;

use App\Models\User;
use app\Models\Role;
use Illuminate\Http\Request;



class UserController extends Controller
{
    public function index()

    {
        $user=user::with('role')->get();

        return view('user.index', ['user'=> $user]);
    }

    public function show($id)
    {
        $user = User::with('role', 'product', 'userGoods')->findorfail($id);

        return view('user.show', ['user'=>$user]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'frist_name'=>'required|max:100',
            'last_name'=> 'required|max:100',
            'email'=> 'required|email|unique:user,email',
            'password'=> 'required|min:8',
            'role_id'=>'required|exists:role,id'//role must exis in role table
        ]);
        
        user::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=> $request->email,
            'password'=>$request->password,
            'role_id'=> $request->role_id

        ]);

        return redirect('/user');


    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'first_name' => 'required|max:100',
        'last_name'  => 'required|max:100',
        'email'      => 'required|email','role_id'=> 'required|exists:role,id'
        ]);

        $user = User::findorfail($id);

        user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'role_id'    => $request->role_id
        ]);

        return redirect('/user');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/user');
    }
}

