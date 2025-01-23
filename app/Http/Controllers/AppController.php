<?php

namespace App\Http\Controllers;

use App\Http\Requests\SavePermissionsRequest;
use App\Models\Group;
use App\Models\Permission;
use App\Services\PermissionSyncService;
use Illuminate\Http\Request;

class AppController extends Controller
{
    protected $permissionSyncService;

    public function __construct(PermissionSyncService $permissionSyncService)
    {
        $this->permissionSyncService = $permissionSyncService;
    }

    public function syncPermissions(Request $request)
    {
        $this->permissionSyncService->syncPermissions();

        $controllers = Permission::distinct('controller_name')->pluck('controller_name');

        $methods = [];
        $groups = Group::all();

        if ($request->has('controller_name')) {
            $methods = Permission::where('controller_name', $request->controller_name)->get();
        }

        return view('admin.permissions', compact('controllers', 'methods', 'groups'));
    }

    public function savePermissions(SavePermissionsRequest $request)
    {
        // dd($request->method_id);
        foreach ($request->permissions ?? [$request->method_id => []] as $methodId => $groupIds) {
            $permission = Permission::findOrFail($methodId);
            $permission->groups()->sync($groupIds);
        }
        $updatedMethodId = $request->method_id;
        return redirect()->route('permissions.manage', ['controller_name' => $request->controller_name])
                     ->with('success', 'Saved')->with('updated_method_id', $updatedMethodId);;
    }
}
