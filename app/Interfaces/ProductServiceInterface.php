<?php

namespace App\Interfaces;

use App\DataTransferObject\ProductDTO;

interface ProductServiceInterface
{
    public function create(ProductDTO $productDTO): ProductDTO;

    public function find(int $id): ?ProductDTO;

    public function update(int $id, ProductDTO $productDTO): ?ProductDTO;

    public function delete(int $id): bool;

    /**
     * @return array|ProductDTO[]
     */
    public function list(): array;
}
