<?php

namespace App\Http\Controllers;

use App\Blog\Post;
use App\Blog\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
        $posts = $this->posts->all();

        $lastPostSlug = Cookie::get('post_last_read', '');

        return view('blog.index', ['posts' => $posts, 'lastPostSlug' => $lastPostSlug]);
    }

    /**
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $slug)
    {
        try {
            $post = $this->posts->find($slug);

            // remember for 2 weeks last Post, so we can show on index where you are
            Cookie::queue('post_last_read', $slug, 60 * 24 * 7 * 2);

            return view('blog.show', ['post' => $post]);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $this->authorize('update', Post::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $slug)
    {
        $this->authorize('update', Post::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $this->authorize('delete', Post::class);
    }
}
