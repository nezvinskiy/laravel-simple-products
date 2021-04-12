<?php

namespace App\DataTransferObject;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class CategoryDTO extends DataTransferObject
{
    public ?int $id;

    public ?string $name;
}
