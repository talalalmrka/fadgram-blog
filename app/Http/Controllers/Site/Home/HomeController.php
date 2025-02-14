<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.home.index', [
            'sections' => [
                view('components.post-grid', [
                    'title' => __('Latest posts'),
                    'posts' => Post::latest()->paginate(),
                ]),
            ],
        ]);
    }
}
