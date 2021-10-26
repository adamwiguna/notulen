<?php

namespace Database\Factories;

use App\Models\NoteDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NoteDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'note_id' => $this->faker->numberBetween(1, 1000),
            'isi_note' => $this->faker->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
