<?php

namespace App\Http\Controllers;

use App\Blog\PostRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @var PostRepository
     */
    private $posts;

    /**
     * BlogController constructor.
     * @param PostRepository $posts
     */
    public function __construct(PostRepository $posts)
    {
        $this->middleware('auth');
        $this->posts = $posts;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        $firstPost = $this->posts->first();

        if ($firstPost) {
            return redirect()->route('blog.show', $firstPost->slug);
        }

        return view('blog.index');
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $slug)
    {
        try {
            $post = $this->posts->find($slug);

            return view('blog.show', ['post' => $post]);
        } catch (\Exception $e) {
            dd($e);
            abort(404);
        }
    }
}
