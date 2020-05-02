<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_on',
    ];

    /**
     * @var ?PostMeta
     */
    public $meta;

    /**
     * @param $value
     * @return string
     */
    public function getTitleAttribute($value): string
    {
        return $value ?: $this->published_on->format('d/m/Y');
    }

    /**
     * @return string
     */
    public function getContentHtmlAttribute(): string
    {
        return app()->make(PostContentRenderer::class)->render($this->attributes['content']);
    }
}
