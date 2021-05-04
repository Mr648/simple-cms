<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random(1)->first()->id,
            'title' => $this->faker->title(),
            'slug' => $this->faker->slug(3),
            'excerpt' => $this->faker->sentence(8),
            'content' => $this->faker->paragraph(4),
        ];
    }
}
