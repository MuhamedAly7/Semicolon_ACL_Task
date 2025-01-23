<?php

namespace App\Services;

use ReflectionClass;
use Illuminate\Support\Facades\File;
use App\Models\Permission;

class PermissionSyncService
{
    protected $excludedControllers = [
        'App\\Http\\Controllers\\AppController',
        'App\\Http\\Controllers\\Controller',
        'App\\Http\\Controllers\\GroupController',
        'App\\Http\\Controllers\\PermissionController',
        'App\\Http\\Controllers\\UserController',
        'App\\Http\\Controllers\\Auth\\AdminAuthController',
        'App\\Http\\Controllers\\Auth\\UserAuthController'
    ];

    public function getAllMethodsFromControllers()
    {
        $controllers = File::allFiles(app_path('Http/Controllers')); // Adjust path as necessary
        $methods = [];
        
        foreach ($controllers as $controller) {
            if (strpos($controller->getFilename(), 'Controller.php') !== false) {
                // Dynamically construct the fully qualified class name
                $class = 'App\\Http\\Controllers\\' . $controller->getRelativePathname();
                $class = str_replace('/', '\\', $class);
                $class = rtrim($class, '.php');  // Remove '.php' extension
            
                if (in_array($class, $this->excludedControllers)) {
                    continue;
                }
            
                $reflection = new ReflectionClass($class);
            
                foreach ($reflection->getMethods() as $method) {
                    $methods[] = [
                        'controller' => $class,
                        'method' => $method->getName()
                    ];
                }
            }
        }
    
        return $methods;
    }

    public function syncPermissions()
    {
        $methods = $this->getAllMethodsFromControllers();

        foreach ($methods as $method) {
            Permission::firstOrCreate([
                'controller_name' => $method['controller'],
                'method_name' => $method['method']
            ]);
        }

        // Optionally delete old methods that no longer exist
        $existingPermissions = Permission::all();

        foreach ($existingPermissions as $permission) {
            $exists = false;

            foreach ($methods as $method) {
                if ($method['controller'] === $permission->controller_name && $method['method'] === $permission->method_name) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $permission->delete();
            }
        }
    }
}
