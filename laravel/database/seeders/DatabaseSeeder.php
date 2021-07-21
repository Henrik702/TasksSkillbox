<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Task;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::factory(5)->create();
        Task::factory()->count(10)->create();
        Box::factory()->count(5)->create();

//        User::factory(10)->make();
//        User::factory(10)->raw();

    }
}
