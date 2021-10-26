<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => Str::random(10),
            'judul' => $this->faker->sentence(mt_rand(4, 15)),
            'user_id' => $this->faker->numberBetween(2, 51),
            'keterangan' => $this->faker->sentence(),
            'tanggal' => date("Y-m-d"),
            'created_at' => now(),
            'updated_at' => now(),
            'division_id' => $this->faker->numberBetween(1, 5),
            'hadir' => $this->faker->name(),
            'pemimpin' => $this->faker->name(),
        ];
    }
}
