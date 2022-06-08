<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * @var array
     */
    private $product;
    /**
     * @var false|mixed
     */
    private $newProduct;
    private $lastId;
    private $lastProduct;

    /**
     * @param $createdProduct
     */
    public function compareProducts($productToCompare, $createdProduct): void
    {
        $this->assertIsArray($createdProduct);

        foreach ($productToCompare as $k => $v) {
            $this->assertEquals($v, $createdProduct[$k]);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = current(Product::factory(1)->make()->toArray());
        $this->newProduct = current(Product::factory(1)->make()->toArray());

        Product::factory(5)->create();
        $this->lastProduct = Product::all()->last()->toArray();
        $this->lastId = $this->lastProduct['id'];
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreation()
    {
        $response = $this->post('/api/product/', $this->product);

        $response->assertStatus(200);
        $createdProduct = $response->json('data');

        $this->compareProducts($this->product, $createdProduct);

        $this->product['id'] = $createdProduct['id'];
    }

    public function testGetProduct()
    {
        $response = $this->get('/api/product/' . $this->lastId);
        $response->assertStatus(200);

        $product = $response->json('data');
        $this->compareProducts($this->lastProduct, $product);
    }

    public function testUpdate()
    {
        $response = $this->put('/api/product/' . $this->lastId, $this->newProduct);
        $response->assertStatus(200);

        $updatedProduct = $response->json('data');

        $this->compareProducts($this->newProduct, $updatedProduct);
    }

    public function testDelete()
    {
        $response = $this->delete('/api/product/' . $this->lastId);
        $response->assertStatus(200);

        $lastProduct = Product::all()->last();
        $this->assertNotEquals($lastProduct->id, $this->lastId);
    }
}
