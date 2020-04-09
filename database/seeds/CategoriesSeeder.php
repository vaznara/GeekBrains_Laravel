<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Спорт',
                'uri_name' => 'sport'
            ],
            [
                'name' => 'Политика',
                'uri_name' => 'politics'
            ],
            [
                'name' => 'Экономика',
                'uri_name' => 'economy'
            ]
        ]);
    }
}
