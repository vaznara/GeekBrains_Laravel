<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => bcrypt('123'),
            'role_id' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@email.com',
            'password' => bcrypt('123'),
            'role_id' => 2
        ]);

        factory(User::class, 50)->create();
    }
}
