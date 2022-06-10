<?php

namespace App\Models;

use App\Casts\CastsEntryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     * Null attributes do not get cast, see
     *  https://laravel.com/docs/9.x/eloquent-mutators#attribute-casting.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
        'status'       => CastsEntryStatus::class,
    ];
}
