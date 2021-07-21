<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TasksToUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->count()->create(['email' => 'admin@admin.am','password' => Hash::make('admin@admin.am')]);

        Task::factory()->count()->create([
            'owner_id' => $user
        ])->each(function (Task $task) {
            $task->box()->saveMany(Box::factory()->count(rand(1,5))->make(['task_id' => '']));
        });
    }
}
