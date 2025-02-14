<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit(GeneralSettings $settings)
    {
        return view('dashboard.settings.general', [
            'settings' => $settings
        ]);
    }

    public function update(Request $request, GeneralSettings $settings)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'active' => 'boolean',
        ]);
        $settings->fill($validated);
        $settings->save();

        return redirect()->back()->with('status', 'Settings updated!');
    }
}
