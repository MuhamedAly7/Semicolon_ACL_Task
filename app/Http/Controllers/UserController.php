<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(10);
        return view('admin.dashboard', compact('users'));
    }

    public function add() {
        $groups = Group::all();
        return view('admin.user_form', compact('groups'));
    }

    public function store(AddUserRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if($request->group_ids) {
            $groupIds = explode(',', $request->group_ids);
            $user->groups()->sync($groupIds);
        }

        return redirect()->route('admin.user.add')->with('success', 'User added successfully!');
    }

    public function edit(User $user) {
        $groups = Group::all();
        return view('admin.user_edit', compact('user', 'groups'));
    }

    public function update(UserUpdateRequest $request, User $user) {
        $user->name = $request->name;
        $user->save();

        $groupIds = is_array($request->group_ids) ? $request->group_ids : explode(',', $request->group_ids);

        $user->groups()->sync($groupIds);

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully!');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully!');
    }
}
