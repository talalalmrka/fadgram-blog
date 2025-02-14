<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        $items = Media::paginate();
        return view('dashboard.media.index', [
            'title' => __('Media library'),
            'items' => $items,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'files' => ['nullable', 'array'],
            'files.*' => ['required', 'file', 'max:102400'],
        ]);
        $user = request()->user();
        $saved = true;
        foreach ($request->file('files') as $file) {
            $save = $user->addMedia($file)->toMediaCollection('library');
            if (!$save) {
                $saved = false;
            }
        }
        if ($saved) {
            return redirect(route('dashboard.media'))->with('status', __('Media uploaded'));
        } else {
            return back()->withErrors([
                'status' => __('Upload Media failed!'),
            ]);
        }
    }

    public function action(Request $request)
    {
        $validated = $request->validate([
            'action' => ['required', 'string', Rule::in(['delete'])],
            'items' => ['required', 'array'],
            'items.*' => ['required', 'integer', Rule::exists('media', 'id')],
        ]);
        $action = data_get($validated, 'action');
        $items = data_get($validated, 'items', []);
        if ($action == 'delete') {
            $delete = Media::destroy($items);
            if ($delete) {
                return back()->with('status', __('Media files deleted'));
            } else {
                return back()->withErrors([
                    'status' => __('Delete media failed!'),
                ]);
            }
        } else {
            return back()->withErrors(['status' => __('Action not supported')]);
        }
    }
    public function delete(Media $media)
    {
        $delete = $media->delete();
        if ($delete) {
            return back()->with('status', __('Media deleted'));
        } else {
            return back()->withErrors([
                'status' => __('Delete media failed!'),
            ]);
        }
    }
}
