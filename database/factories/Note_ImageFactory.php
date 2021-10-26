<?php

namespace Database\Factories;

use App\Models\Note_Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class Note_ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note_Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'note_id' => $this->faker->numberBetween(1, 1000),
            'image_url' => 'https://source.unsplash.com/featured/?meeting',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
