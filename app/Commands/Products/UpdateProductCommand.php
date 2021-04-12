<?php

namespace App\Commands\Products;

use App\Interfaces\ProductServiceInterface;
use App\DataTransferObject\ProductDTO;

class UpdateProductCommand
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function execute(int $id, ProductDTO $productDTO): void
    {
        $this->productService->update($id, $productDTO);
    }
}
