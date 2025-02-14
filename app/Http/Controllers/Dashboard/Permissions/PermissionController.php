<?php

namespace App\Http\Controllers\Dashboard\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate();
        return view('dashboard.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    public function create()
    {
        return view('dashboard.permissions.edit', [
            'permission' => new Permission(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions', 'name')],
            'guard_name' => ['required', 'string', 'max:255', Rule::in(guard_names())],
        ]);
        $permission = Permission::create($validated);
        if ($permission) {
            return redirect(route('dashboard.permissions.edit', $permission))->with('status', __('Permission :name saved.', [
                'name' => $permission->name,
            ]));
        } else {
            return back()->withErrors([
                'status' => __('Create Permission failed!'),
            ]);
        }
    }

    public function edit(Permission $permission)
    {
        return view('dashboard.permissions.edit', [
            'permission' => $permission,
        ]);
    }
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('permissions', 'name')->ignore($permission?->id)],
            'guard_name' => ['required', 'string', 'max:255', Rule::in(guard_names())],
        ]);
        $save = $permission->update($validated);
        if ($save) {
            return back()->with('status', __('permission :name saved.', [
                'name' => data_get($validated, 'name'),
            ]));
        } else {
            return back()->withErrors([
                'status' => __('Save permission failed!'),
            ]);
        }
    }

    public function action(Request $request)
    {
        $validated = $request->validate([
            'action' => ['required', 'string', Rule::in(['delete'])],
            'items' => ['required', 'array'],
            'items.*' => ['required', 'integer', Rule::exists('permissions', 'id')],
        ]);
        $action = data_get($validated, 'action');
        $items = data_get($validated, 'items', []);
        if ($action == 'delete') {
            $delete = Permission::destroy($items);
            if ($delete) {
                return back()->with('status', __('Permissions deleted'));
            } else {
                return back()->withErrors([
                    'status' => __('Delete permission failed'),
                ]);
            }
        } else {
            return back()->withErrors(['status' => __('Action not supported')]);
        }
    }
    public function delete(Permission $permission)
    {
        $delete = $permission->delete();
        if ($delete) {
            return back()->with('status', __('Permission deleted'));
        } else {
            return back()->withErrors([
                'status' => __('Delete permission failed'),
            ]);
        }
    }

}