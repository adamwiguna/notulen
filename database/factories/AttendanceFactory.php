<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'note_id' => $this->faker->numberBetween(1, 1000),
            'nama' => $this->faker->name(),
            'instansi' => $this->faker->company(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
