<?php

namespace App;

use Illuminate\Support\Str;

class MdPostFactory implements PostFactory
{
    /**
     * @param string $content
     * @param string $title
     * @param string $slug
     * @return Post
     */
    public function make($content, $title = '', $slug = '')
    {
        $title = $title ?: $this->getTitleFromContent($content);
        $slug  = $slug ?: Str::slug($title);

        return new Post($title, $content, $slug);
    }

    private function getTitleFromContent($content)
    {
        return 'aha';
    }
}