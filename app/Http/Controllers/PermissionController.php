<?php

namespace App\Http\Controllers;

use App\Services\PermissionSyncService;

class PermissionController extends Controller
{

    protected $permissionSyncService;

    // Inject the PermissionSyncService into the controller
    public function __construct(PermissionSyncService $permissionSyncService)
    {
        $this->permissionSyncService = $permissionSyncService;
    }

    public function syncPermissions()
    {
        // Call the syncPermissions method from the service
        $this->permissionSyncService->syncPermissions();

        // Return a response indicating success
        return response()->json(['message' => 'Permissions synced successfully!']);
    }
}
