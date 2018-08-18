<?php

namespace Tests\Unit\Models\Products\Categories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Products\Category;

class CategoryTest extends TestCase
{
    public function test_has_many_children()
    {
        $category = factory(Category::class)->create();

        $category->children()->save(factory(Category::class)->create());

        $this->assertInstanceOf(Category::class, $category->children->first());
    }

    public function test_can_get_parents()
    {
        $category = factory(Category::class)->create();

        $category->children()->save(factory(Category::class)->create());

        $this->assertEquals(1, Category::parents()->count());
    }

    public function test_is_ordered()
    {
        factory(Category::class)->create([
            'order' => 2
        ]);

        $category = factory(Category::class)->create([
            'order' => 1
        ]);

        $this->assertEquals($category->name, Category::ordered()->first()->name);
    }
}
