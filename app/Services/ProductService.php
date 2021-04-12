<?php

namespace App\Services;

use App\DataTransferObject\ProductDTO;
use App\DataTransferObject\CategoryDTO;
use App\Interfaces\ProductServiceInterface;
use App\Models\Product;

class ProductService implements ProductServiceInterface
{
    public function create(ProductDTO $productDTO): ProductDTO
    {
        $product = new Product();
        $product->name = $productDTO->name;
        $product->description = $productDTO->description;
        $product->price = $productDTO->price;
        $product->save();

        $product->categories()->attach($this->getCategoryIds($productDTO->categories));

        return $product->convertToDTO();
    }

    public function update(int $id, ProductDTO $productDTO): ?ProductDTO
    {
        if (! $product = Product::find($id)) {
            return null;
        }

        $product->name = $productDTO->name;
        $product->description = $productDTO->description;
        $product->price = $productDTO->price;
        $product->save();

        $product->categories()->sync($this->getCategoryIds($productDTO->categories));

        return $product->convertToDTO();
    }

    public function find(int $id): ?ProductDTO
    {
        if (! $product = Product::find($id)) {
            return null;
        }
        return $product->convertToDTO();
    }

    public function delete(int $id): bool
    {
        if (! $product = Product::find($id)) {
            return false;
        }
        return $product->delete();
    }

    /**
     * @return array|ProductDTO[]
     */
    public function list(): array
    {
        return Product::query()
            ->orderByDesc('id')
            ->get()
            ->map(static function (Product $product) {
                return $product->convertToDTO();
            })->toArray();
    }

    /**
     * @param array|CategoryDTO[] $categories
     * @return array
     */
    private function getCategoryIds(array $categories): array
    {
        return array_map(static fn(CategoryDTO $сategory) => $сategory->id, $categories);
    }
}
