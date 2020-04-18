<?php

use Illuminate\Database\Seeder;
use App\News;
use App\Category;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(News::class, 50)->create();
    }
}
