<?php

namespace Database\Factories;

use App\Models\ForumThemeMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumThemeMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ForumThemeMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "message" => $this->faker->realText(rand(200,500)),
            "created_at" => $this->faker->dateTimeBetween('-30 days','-1 days'),
        ];
    }
}
