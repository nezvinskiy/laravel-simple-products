<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    private string $createUrl = '/products/create';
    private string $storeUrl = '/products/store';

    public function test_create_product_not_auth(): void
    {
        $response = $this->get($this->createUrl);

        $response->assertStatus(302);
    }

    public function test_create_product_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get($this->createUrl);

        $response->assertStatus(200);
    }

    public function test_create_product_with_invalid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post($this->storeUrl, [
            'name' => '',
            'price' => '',
            'categories' => '',
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors([
                'name',
                'price',
                'categories',
            ]);
    }

    public function test_create_product_with_invalid_categories(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post($this->storeUrl, [
            'name' => 'Product name 1',
            'price' => 5.27,
            'description' => 'Product description 1',
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors([
                'categories',
            ]);
    }

    public function test_create_product_with_valid_data(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post($this->storeUrl, [
            'name' => 'Product name 1',
            'price' => 5.27,
            'description' => 'Product description 1',
            'categories' => [
                [
                    'id' => $category->id,
                ],
            ],
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_create_product_with_valid_data_without_description(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post($this->storeUrl, [
            'name' => 'Product name 1',
            'price' => 5.27,
            'categories' => [
                [
                    'id' => $category->id,
                ],
            ],
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}
