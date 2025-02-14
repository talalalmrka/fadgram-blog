<?php

namespace App\Http\Controllers\Dashboard\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate();
        return view('dashboard.roles.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('dashboard.roles.edit', [
            'role' => new Role(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')],
            'guard_name' => ['required', 'string', 'max:255', Rule::in(guard_names())],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['required', 'string', Rule::exists('permissions', 'name')],
        ]);
        $role = Role::create($validated);
        if ($role) {
            $role->syncPermissions(array_values($request->permissions));
            return redirect(route('dashboard.roles.edit', $role))->with('status', __('role :name saved.', [
                'name' => $role->name,
            ]));
        } else {
            return back()->withErrors([
                'status' => __('Create role failed!'),
            ]);
        }
    }

    public function edit(Role $role)
    {
        return view('dashboard.roles.edit', [
            'role' => $role,
        ]);
    }
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($role?->id)],
            'guard_name' => ['required', 'string', 'max:255', Rule::in(guard_names())],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['required', 'string', Rule::exists('permissions', 'name')],
        ]);
        $save = $role->update($validated);
        //dd($request->permissions);
        if ($save) {
            $role->syncPermissions(array_values($request->permissions));
            return back()->with('status', __('role :name saved.', [
                'name' => data_get($validated, 'name'),
            ]));
        } else {
            return back()->withErrors([
                'status' => __('Save role failed!'),
            ]);
        }
    }

    public function action(Request $request)
    {
        $validated = $request->validate([
            'action' => ['required', 'string', Rule::in(['delete'])],
            'items' => ['required', 'array'],
            'items.*' => ['required', 'integer', Rule::exists('roles', 'id')],
        ]);
        $action = data_get($validated, 'action');
        $items = data_get($validated, 'items', []);
        if ($action == 'delete') {
            $delete = Role::destroy($items);
            if ($delete) {
                return back()->with('status', __('roles deleted'));
            } else {
                return back()->withErrors([
                    'status' => __('Delete role failed'),
                ]);
            }
        } else {
            return back()->withErrors(['status' => __('Action not supported')]);
        }
    }
    public function delete(Role $role)
    {
        $delete = $role->delete();
        if ($delete) {
            return back()->with('status', __('role deleted'));
        } else {
            return back()->withErrors([
                'status' => __('Delete role failed'),
            ]);
        }
    }

}