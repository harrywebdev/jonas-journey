<?php

namespace App;

interface PostRepository
{
    /**
     * @return Post[]
     */
    public function all();
}