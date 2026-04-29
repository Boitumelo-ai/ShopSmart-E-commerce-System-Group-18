<?php

namespace App\Http\Controllers;

use App\Models\user;
use\app\models\role;
use Illuminate\Http\Request;



class UserController extends Controller
{
    public function index()

    {
        $users=user::with('role')->get();

        return view('users.index', ['users'=> $users]);
    }

    public function show($id)
    {
        $user = User::with('role', 'products', 'userGoods')->findorfail($id);

        return view('users.show', ['user'=>$user]);
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

        return redirect('/users');


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

        return redirect('/users');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/users');
    }
}

