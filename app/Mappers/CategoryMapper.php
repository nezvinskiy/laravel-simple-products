<?php

namespace App\Mappers;

use App\DataTransferObject\ProductDTO;
use App\DataTransferObject\CategoryDTO;

class CategoryMapper
{
    /**
     * @param ProductDTO $productDTO
     * @param array|CategoryDTO[] $categories
     * @return array
     */
    public function map(ProductDTO $productDTO, array $categories): array
    {
        $ids = $this->getIds($productDTO->categories);

        return array_map(static fn (CategoryDTO $item) => [
            'id' => $item->id,
            'name' => $item->name,
            'enable' => \in_array($item->id, $ids, true),
        ], $categories);
    }

    private function getIds(array $categories): array
    {
        return array_map(static fn(CategoryDTO $сategory) => $сategory->id, $categories);
    }
}
