<?php

namespace Tests\Feature;

use App\Models\News\Categories;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class routesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexRoute()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testAboutRoute()
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }

    public function testLoginRoute()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function testNewsRoute()
    {
        $response = $this->get('/news');
        $response->assertStatus(404);

        $response = $this->get('/news/categories');
        $response->assertStatus(200);

        $response = $this->get('/news/1');
        $response->assertStatus(200);

        $categories = New Categories();
        $response = $this->get('/news/categories/' . $categories->getCategories()[1]['uri_name']);
        $response->assertStatus(200);
    }

    public function testAdminRoutes() {
        $response = $this->get('/admin');
        $response->assertStatus(200);

        $response = $this->get('/admin/addnews');
        $response->assertStatus(200);

        $response = $this->post('/admin/addnews', ['news-header' => '', 'category-selector' => '', 'news-body' => '']);
        $response->isRedirect();
    }
}
