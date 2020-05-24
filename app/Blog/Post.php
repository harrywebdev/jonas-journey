<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
        $birthdate  = Carbon::createMidnightDate(2020, 4, 15);
        $diffInDays = $birthdate->diffInDays($this->published_on);

        return $value ?: $this->published_on->formatLocalized('%e. %B %Y, %A') . " (den $diffInDays)";
    }

    /**
     * @return string
     */
    public function getContentHtmlAttribute(): string
    {
        return app()->make(PostContentRenderer::class)->render($this->attributes['content']);
    }

    /**
     * @return string
     */
    public function getContentAttribute(): string
    {
        return str_replace('/assets/img', '/storage/media', $this->attributes['content']);
    }
}
