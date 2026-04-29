<?php

namespace App\Http\Controllers;
use Illuminate\Https\Request;


class RoleController extends Controller
{
//index-shows all roles, runs when someone visits roles   
public function index()
{
    //get all roles from the database
    $roles = Role::all();

    return view('roles.index', ['roles'=> $roles]);
}

//show one specofic role
//$id is the role's id passed in the URL
public function show($id)
{
    //find role with this id or fail with a 404 error
    $role=Role::findorfail($id);

    return view('roles.show', ['role'=>$role]);
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:50'
    ]);

    Role::create([
        'name'=>$request->name
    ]);

    return redirect('/roles');

}

public function update(Request $request, $id)
{
    $request->validate([
        'name'=> 'required|max:50'
    ]);

    //find role we want to update
    $role = Role::findorfail($id);

    $role->update([
        'name'=> $request->name
    ]);

    return redirect('/roles');
}


public function destroy($id)
{
    $role = Role::findorfail($id);

    $role->delete();
    
    return redirect('/roles');
}

}
