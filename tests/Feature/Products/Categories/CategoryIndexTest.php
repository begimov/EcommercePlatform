<?php

namespace Tests\Feature\Products\Categories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\Category;

class CategoryIndexTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_returns_collection_with_category()
    {
        $category  = factory(Category::class)->create();

        $this->json('GET', 'api/categories')
            ->assertJsonFragment([
                'slug' => $category->slug
            ]);
    }

    public function test_returns_collection_of_categories()
    {
        $categories  = factory(Category::class, 2)->create();

        $this->json('GET', 'api/categories')
            ->assertJsonFragment(
                [
                    'slug' => $categories[0]->slug
                ],
                [
                    'slug' => $categories[1]->slug
                ]);
    }
}
