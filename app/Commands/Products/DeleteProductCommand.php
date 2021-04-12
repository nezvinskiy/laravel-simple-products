<?php

namespace App\Commands\Products;

use App\Interfaces\ProductServiceInterface;

class DeleteProductCommand
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function execute(int $id): void
    {
        $this->productService->delete($id);
    }
}
