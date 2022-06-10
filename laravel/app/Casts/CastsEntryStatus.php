<?php

namespace App\Casts;

use App\Domain\Entries\EntryStatus;
use App\Models\Entry;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CastsEntryStatus implements CastsAttributes
{
    /**
     * Cast the given value to SlotEntryStatus. Change the status as following:
     *  * `CONFIRMED` => `IN_PROGRESS` when it's started already.
     *
     * @param Entry  $model
     * @param string $key
     * @param mixed  $value
     * @param array  $attributes
     *
     * @return EntryStatus
     */
    public function get($model, string $key, $value, array $attributes)
    {
        $status = new EntryStatus($value);

        return $status;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string                              $key
     * @param EntryStatus|string                  $value
     * @param array                               $attributes
     *
     * @return string
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (!$value instanceof EntryStatus) {
            return (string)$value;
        }

        // @var EntryStatus $value
        return $value->getValue();
    }
}
