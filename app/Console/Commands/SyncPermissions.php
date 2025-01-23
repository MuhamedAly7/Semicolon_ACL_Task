<?php

namespace App\Console\Commands;

use App\Services\PermissionSyncService;
use Illuminate\Console\Command;

class SyncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync permissions from controllers and methods';

    protected $permissionSyncService;

    public function __construct(PermissionSyncService $permissionSyncService)
    {
        parent::__construct();
        $this->permissionSyncService = $permissionSyncService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Call the syncPermissions method from the service
        $this->permissionSyncService->syncPermissions();

        // Output success message
        $this->info('Permissions synced successfully!');
    }
}
