<?php

namespace App\DataTransferObject;

use Spatie\DataTransferObject\Caster;
use Exception;

class CategoryArrayCaster implements Caster
{
    public function cast(mixed $value): array
    {
        if (! \is_array($value)) {
            throw new Exception('Can only cast arrays to Category');
        }

        return array_map(
            fn (array $data) => new CategoryDTO(...$data),
            $value
        );
    }
}
