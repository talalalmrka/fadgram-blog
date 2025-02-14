<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        return view('dashboard.users.index', [
            'users' => $users,
        ]);
    }
    public function create()
    {
        return view('dashboard.users.edit', [
            'user' => new User(),
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:4', 'max:255'],
            'roles' => ['required', 'array'],
            'roles.*' => ['required', 'string', Rule::exists('roles', 'name')],
        ]);
        $user = User::create($validated);
        if ($user) {
            $user->syncRoles(array_values($request->roles));
            return redirect(route('dashboard.users.edit', $user))->with('status', __('User :name saved.', [
                'name' => $user->name,
            ]));
        } else {
            return back()->withErrors([
                'status' => __('Create user failed!'),
            ]);
        }
    }
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($user?->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user?->id)],
            'roles' => ['required', 'array'],
            'roles.*' => ['required', 'string', Rule::exists('roles', 'name')],
        ]);
        $save = $user->update($validated);
        if ($save) {
            $user->syncRoles(array_values($request->roles));
            return back()->with('status', __('User :name saved.', [
                'name' => data_get($validated, 'name'),
            ]));
        } else {
            return back()->withErrors([
                'status' => __('Save user failed!'),
            ]);
        }
    }
    public function action(Request $request)
    {
        $validated = $request->validate([
            'action' => ['required', 'string', Rule::in(['delete'])],
            'items' => ['required', 'array'],
            'items.*' => ['required', 'integer', Rule::exists('users', 'id')],
        ]);

        //dd($validated);
        $action = data_get($validated, 'action');
        $items = data_get($validated, 'items', []);
        if ($action == 'delete') {
            $delete = User::destroy($items);
            if ($delete) {
                return back()->with('status', __('Users deleted'));
            } else {
                return back()->withErrors([
                    'status' => __('Delete Users failed'),
                ]);
            }
        } else {
            return back()->withErrors(['status' => __('Action not supported')]);
        }
    }
    public function delete(User $user)
    {
        $delete = $user->delete();
        if ($delete) {
            return back()->with('status', __('User :name deleted', [
                'name' => $user->name,
            ]));
        } else {
            return back()->withErrors([
                'status' => __('Delete user failed'),
            ]);
        }
    }

    public function login(User $user)
    {
        auth()->login($user);
        return redirect(route('dashboard'));
    }

}
