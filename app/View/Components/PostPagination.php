<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostPagination extends Component
{
    /**
     * @var null|string
     */
    public $previousPostSlug;

    /**
     * @var null|string
     */
    public $nextPostSlug;

    /**
     * Create a new component instance.
     *
     * @param string|null $previousPostSlug
     * @param string|null $nextPostSlug
     */
    public function __construct(string $previousPostSlug = null, string $nextPostSlug = null)
    {
        //
        $this->previousPostSlug = $previousPostSlug;
        $this->nextPostSlug     = $nextPostSlug;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.post-pagination');
    }
}
