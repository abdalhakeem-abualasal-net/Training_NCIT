<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function deleteUser(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->route('allusers')->with('success', 'User deleted successfully');
    }

    public function updateUserRole(Request $request)
    {
        $userId = $request->input('user_id');
        $newRole = $request->input('new_role');

        $user = User::find($userId);
        if ($user) {
            $user->isadmin = ($newRole == 'admin') ? true : false;
            $user->save();
            return redirect()->back()->with('success', 'User role updated successfully');
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }


}
