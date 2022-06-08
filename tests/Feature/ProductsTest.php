<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;

class ProductsTest extends TestCase
{

    const PRODUCT_COUNT = 3;

    public function setUp(): void
    {
        parent::setUp();

        Product::factory(self::PRODUCT_COUNT)->create();
    }

    public function testListAll()
    {
        $response = $this->get('/api/products/list');
        $response->assertStatus(200);
        $responseData = $response->json('data');

        $this->assertCount(self::PRODUCT_COUNT, $responseData);
    }

    public function testGetValue()
    {
        $response = $this->get('/api/products/value');
        $response->assertStatus(200);
    }
}
