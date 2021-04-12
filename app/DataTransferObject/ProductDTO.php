<?php

namespace App\DataTransferObject;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\Attributes\CastWith;

#[Strict]
class ProductDTO extends DataTransferObject
{
    public ?int $id;

    public string $name;

    public ?string $description;

    public float $price;

    #[CastWith(CategoryArrayCaster::class)]
    public array $categories;
}
