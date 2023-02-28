<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
    public function index()
    {
        $all_users = User::withTrashed()->latest()->get();

        return view('admin.users.index')->with('all_users',$all_users);
    }

    public function deactivate($id){
        User::destroy($id);

        return redirect()->back();
    }

    public function activate($id){
        User::withTrashed()->FindOrfail($id)->restore();

        return redirect()->back();
    }

}
