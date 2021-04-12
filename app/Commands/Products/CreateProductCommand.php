<?php

namespace App\Commands\Products;

use App\Interfaces\ProductServiceInterface;
use App\DataTransferObject\ProductDTO;

class CreateProductCommand
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function execute(ProductDTO $productDTO): void
    {
        $this->productService->create($productDTO);
    }
}
