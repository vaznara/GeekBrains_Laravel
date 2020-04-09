<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->createData());
    }

    private function createData()
    {
        $dataFaker = Faker\Factory::create('ru_RU');
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'title' => $dataFaker->realText(rand(10, 50)),
                'body' => $dataFaker->realText(rand(1000, 2000)),
                'isPrivate' => $dataFaker->boolean(50),
                'category_id' => rand(1, 3)
            ];
        }

        return $data;
    }
}
