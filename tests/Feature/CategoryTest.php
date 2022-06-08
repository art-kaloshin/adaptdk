<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetCategoriesList()
    {
        Category::factory(10)->create();

        $response = $this->get('/api/categories/list');
        $response->assertStatus(200);

        $this->assertNotEmpty($response->json('data'));
    }
}
