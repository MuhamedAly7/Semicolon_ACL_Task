<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Models\Group;

class GroupController extends Controller
{
    public function index() {
        $groups = Group::all();
        return view('admin.groups', compact('groups'));
    }

    public function add() {
        return view('admin.group_form');
    }

    public function store(StoreGroupRequest $request) {
        Group::create([
            'name' => $request->group_name
        ]);
        return redirect()->route('admin.group.add')->with('success', 'Group added successfully!');
    }

    public function destroy(Group $group) {
        $group->delete();
        return redirect()->route('admin.group.index')->with('success', 'Group deleted successfully!');
    }
}
