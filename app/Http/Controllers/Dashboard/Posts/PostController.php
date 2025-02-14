<?php

namespace App\Http\Controllers\Dashboard\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate();
        return view('dashboard.posts.index', [
            'posts' => $posts,
        ]);
    }
    public function create()
    {
        return view('dashboard.posts.edit', [
            'post' => new Post(),
        ]);
    }

    public function validatePost(Request $request, ?Post $post = null)
    {
        return $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($post?->id)],
            'description' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string', /*'max:20000'*/],
            'thumbnail' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'pdf' => ['nullable', 'file', 'mimes:pdf', 'max:104857600'],
        ]);
    }
    public function store(Request $request)
    {
        if (empty($request->slug)) {
            $request->merge([
                'slug' => Post::generateSlug($request->name),
            ]);
        }
        $validated = $this->validatePost($request);
        $post = Post::create($validated);
        if ($post) {
            $this->saveThumbnail($request, $post);
            $this->savePdf($request, $post);
            return redirect(route('dashboard.posts.edit', $post))->with('status', __('Post created'));
        } else {
            return back()->withErrors([
                'status' => __('Create post failed!'),
            ]);
        }
    }
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
        ]);
    }
    public function saveThumbnail(Request $request, Post $post)
    {
        if ($request->file('thumbnail')) {
            $saveThumbnail = $post->setThumbnail($request->file('thumbnail'));
            if ($saveThumbnail) {
                session()->flash('thumbnail', __('Featured image updated.'));
            } else {
                session()->flash('errors', new \Illuminate\Support\MessageBag([
                    'thumbnail' => 'Failed update featured image!',
                ]));
            }
        }
    }
    public function savePdf(Request $request, Post $post)
    {
        if ($request->file('pdf')) {
            $savePdf = $post->addMedia($request->file('pdf'))->toMediaCollection('pdf');
            if ($savePdf) {
                session()->flash('pdf', __('Pdf updated.'));
            } else {
                session()->flash('errors', new \Illuminate\Support\MessageBag([
                    'pdf' => 'Failed update featured image!',
                ]));
            }
        }
    }
    public function update(Request $request, Post $post)
    {
        if (empty($request->slug)) {
            $request->merge([
                'slug' => Post::generateSlug($request->name),
            ]);
        }
        $validated = $this->validatePost($request, $post);
        $save = $post->update($validated);
        if ($save) {
            $this->saveThumbnail($request, $post);
            $this->savePdf($request, $post);
            return back()->with('status', __('Post saved.'));
        } else {
            return back()->withErrors([
                'status' => __('Save post failed!'),
            ]);
        }
    }
    public function action(Request $request)
    {
        $validated = $request->validate([
            'action' => ['required', 'string', Rule::in(['delete'])],
            'items' => ['required', 'array'],
            'items.*' => ['required', 'integer', Rule::exists('posts', 'id')],
        ]);
        $action = data_get($validated, 'action');
        $items = data_get($validated, 'items', []);
        if ($action == 'delete') {
            $delete = Post::destroy($items);
            if ($delete) {
                return back()->with('status', __('Posts deleted'));
            } else {
                return back()->withErrors([
                    'status' => __('Delete posts failed'),
                ]);
            }
        } else {
            return back()->withErrors(['status' => __('Action not supported')]);
        }
    }
    public function delete(Post $post)
    {
        $delete = $post->delete();
        if ($delete) {
            return back()->with('status', __('Post deleted'));
        } else {
            return back()->withErrors([
                'status' => __('Delete post failed'),
            ]);
        }
    }
}
