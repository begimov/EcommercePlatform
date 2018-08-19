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

    public function test_returns_only_parent_categories()
    {
        $category  = factory(Category::class)->create();

        factory(Category::class)->create();

        $category->children()->save(
            $subcategory = factory(Category::class)->create()
        );

        $this->json('GET', 'api/categories')
            ->assertJsonFragment(
                [
                    'slug' => $category->slug
                ]
            )
            ->assertJsonCount(2, 'data');
    }

    public function test_returns_categories_in_order()
    {
        $category1  = factory(Category::class)->create([
            'order' => 2
        ]);

        $category2  = factory(Category::class)->create([
            'order' => 1
        ]);

        $this->json('GET', 'api/categories')
            ->assertSeeInOrder([
                $category2->name,
                $category1->name,
            ]);
    }
}
