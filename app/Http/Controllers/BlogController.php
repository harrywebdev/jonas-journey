<?php

namespace App\Http\Controllers;

use App\Blog\PostRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @param PostRepository $posts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(PostRepository $posts)
    {
        return view('blog.index', ['posts' => $posts->all()]);
    }
}
