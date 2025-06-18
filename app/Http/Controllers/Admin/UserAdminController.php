<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    // 更新用户角色：例如传 role 字段，值为 'reviewer','author','admin','remove_reviewer','remove_admin'
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role'=>'required|in:admin,reviewer,author,remove_reviewer,remove_admin',
        ]);
        $role = $request->role;
        if ($role==='admin') {
            $user->assignRole('admin');
        } elseif ($role==='reviewer') {
            $user->assignRole('reviewer');
        } elseif ($role==='author') {
            $user->assignRole('author');
        } elseif ($role==='remove_reviewer') {
            $user->removeRole('reviewer');
        } elseif ($role==='remove_admin') {
            $user->removeRole('admin');
        }
        return redirect()->route('admin.users.index')->with('success','用户角色已更新');
    }
}