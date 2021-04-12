<?php

namespace App\Services;

use App\DataTransferObject\CategoryDTO;
use App\Interfaces\CategoryServiceInterface;
use App\Models\Category;

class CategoryService implements CategoryServiceInterface
{
    /**
     * @return array|CategoryDTO[]
     */
    public function list(): array
    {
        return Category::query()
            ->orderBy('name')
            ->get()
            ->map(static function (Category $category) {
                return $category->convertToDTO();
            })->toArray();
    }
}
