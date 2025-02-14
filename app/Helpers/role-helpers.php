<?php
use Spatie\Permission\Models\Role;

if (!function_exists('RoleOtions')) {
    function role_options()
    {
        $roles = Role::all();
        return $roles->map(function (Role $role) {
            return [
                'value' => $role->name,
                'label' => $role->name,
            ];
        })->toArray();
    }
}