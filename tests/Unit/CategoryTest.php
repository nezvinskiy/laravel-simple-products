<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\DataTransferObject\CategoryDTO;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CategoryTest extends TestCase
{
    public function test_сategory(): void
    {
        $category = new CategoryDTO(
            id: 1,
            name: 'Category 1',
        );

        $this->assertSame(1, $category->id);
        $this->assertSame('Category 1', $category->name);
    }

    public function test_сategory_with_unknown_field(): void
    {
        $this->expectException(UnknownProperties::class);

        $category = new CategoryDTO(
            id: 1,
            name: 'Category 1',
            test: 'a',
        );
    }
}
