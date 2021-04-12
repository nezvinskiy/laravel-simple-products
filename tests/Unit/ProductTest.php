<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\DataTransferObject\ProductDTO;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ProductTest extends TestCase
{
    public function test_product(): void
    {
        $product = new ProductDTO(
            id: 1,
            name: 'Product 1',
            description: 'Product description 1',
            price: 7.89,
            categories: [
                [
                    'id' => 1,
                ],
            ],
        );

        $this->assertSame(1, $product->id);
        $this->assertSame('Product 1', $product->name);
        $this->assertSame('Product description 1', $product->description);
        $this->assertSame(7.89, $product->price);

        foreach ($product->categories as $category) {
            $this->assertSame(1, $category->id);
        }
    }

    public function test_product_with_unknown_field(): void
    {
        $this->expectException(UnknownProperties::class);

        $product = new ProductDTO(
            id: 1,
            name: 'Product 1',
            description: 'Product description 1',
            price: 7.89,
            categories: [
                [
                    'id' => 1,
                ],
            ],
            test: 'b',
        );
    }
}
