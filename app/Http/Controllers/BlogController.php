<?php

namespace App\Http\Controllers;

use App\Blog\Post;
use App\Blog\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        return view('blog.create', [
            'defaultPublishedOn' => Carbon::now()->format('Y-m-d'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $data = $request->validate([
            'published_on' => 'required|date_format:Y-m-d',
            'content'      => 'required|max:65535',
            'status'       => ['required', Rule::in(['published', 'draft'])],
        ]);

        try {
            $post = $this->posts->create($data);

            return redirect()->route('blog.show', ['slug' => $post->slug]);
        } catch (\Exception $e) {
            return redirect()->route('blog.create')->withInput($data)->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $slug)
    {
        try {
            $post = $this->posts->find($slug);
        } catch (\Exception $e) {
            abort(404);
        }

        $this->authorize('update', $post);

        return view('blog.edit', ['post' => $post,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $slug)
    {
        try {
            $post = $this->posts->find($slug);
        } catch (\Exception $e) {
            abort(404);
        }

        $this->authorize('update', $post);

        $data = $request->validate([
            'published_on' => 'required|date_format:Y-m-d',
            'content'      => 'required|max:65535',
            'status'       => ['required', Rule::in(['published', 'draft'])],
        ]);

        try {
            $post = $this->posts->update($post->slug, $data);

            return redirect()->route('blog.show', ['slug' => $post->slug]);
        } catch (\Exception $e) {
            return redirect()->route('blog.edit')->withInput($data)->withErrors($e->getMessage());
        }
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
