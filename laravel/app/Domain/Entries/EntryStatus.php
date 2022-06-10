<?php

namespace App\Domain\Entries;

use MyCLabs\Enum\Enum;

/**
 * Class EntryStatus.
 *
 * @method static EntryStatus PUBLIC()
 * @method static EntryStatus PRIVATE()
 * @method static EntryStatus DRAFT()
 */
final class EntryStatus extends Enum
{
    private const PUBLIC = 'public';
    private const PRIVATE = 'private';
    private const DRAFT = 'draft';
}

