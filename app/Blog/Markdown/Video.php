<?php

namespace App\Blog\Markdown;

use League\CommonMark\Inline\Element\AbstractWebResource;

class Video extends AbstractWebResource
{

    /**
     * Video constructor.
     */
    public function __construct(string $url, ?string $title = null)
    {
        parent::__construct($url);

        if (!empty($title)) {
            $this->data['title'] = $title;
        }
    }
}