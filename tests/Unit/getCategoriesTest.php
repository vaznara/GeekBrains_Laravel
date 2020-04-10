<?php

namespace Tests\Unit;

use App\Models\News\Categories;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class getCategoriesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testGetCategories () {
        $categories = New Categories();
        $this->assertIsArray($categories->getCategories());
    }
}
