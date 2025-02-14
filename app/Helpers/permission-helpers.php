<?php

use Spatie\Permission\Models\Permission;
if (!function_exists('permission_options')) {
    function permission_options()
    {
        $permissions = Permission::all();
        return $permissions->map(function (Permission $permission) {
            return [
                'value' => $permission->name,
                'label' => $permission->name,
            ];
        })->toArray();
    }
}