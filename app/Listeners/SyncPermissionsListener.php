<?php

namespace App\Listeners;

use App\Events\PermissionsSynced;
use App\Services\PermissionSyncService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncPermissionsListener
{
    protected $permissionSyncService;

    public function __construct(PermissionSyncService $permissionSyncService)
    {
        $this->permissionSyncService = $permissionSyncService;
    }

    public function handle(PermissionsSynced $event)
    {
        // Call the method to sync permissions
        $this->permissionSyncService->syncPermissions();
    }
}
