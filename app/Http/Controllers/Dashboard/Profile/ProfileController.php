<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use Milwad\LaravelValidate\Rules\ValidPhoneNumber;
class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('dashboard.profile.index', [
            'user' => $user,
            'title' => __('Profile ":name"', ['name' => $user->name]),
        ]);
    }

    public function accountUpdate(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
        ]);
        $update = $user->update($validated);
        if ($update) {
            return back()->with('account', __('Account updated.'));
        } else {
            return back()->withErrors([
                'account' => __('Update account failed!'),
            ]);
        }
    }
    public function personalUpdate(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'display_name' => ['nullable', 'string', 'max:255'],
        ]);
        $update = $user->saveMeta($validated);
        if ($update) {
            return back()->with('personal', __('Updated.'));
        } else {
            return back()->withErrors([
                'account' => __('Update failed!'),
            ]);
        }
    }
    public function contactUpdate(Request $request)
    {
        $user = auth()->user();
        //dd($request->all());
        $validated = $request->validate([
            'phone' => ['nullable', new ValidPhoneNumber()],
            'website' => ['nullable', 'url', 'max:255'],
            'whatsapp' => ['nullable', new ValidPhoneNumber()],
            'facebook' => ['nullable', 'url', 'max:255'],
        ]);
        //dd($validated);
        $update = $user->saveMeta($validated);
        if ($update) {
            return back()->with('contact', __('Updated.'));
        } else {
            return back()->withErrors([
                'contact' => __('Update failed!'),
            ]);
        }
    }
}