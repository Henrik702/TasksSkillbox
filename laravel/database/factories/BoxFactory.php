<?php

namespace Database\Factories;

use App\Models\Box;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Box::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentence,
            'task_id' => Task::factory()->create(),

        ];
    }
}
