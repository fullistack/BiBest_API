<?php

namespace Database\Factories;

use App\Models\ForumTheme;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumThemeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ForumTheme::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->jobTitle(),
            "type" => rand(0,10) > 8 ? $this->faker->randomElement(ForumTheme::TYPES) : ForumTheme::TYPE_NORMAL,
            "created_at" => $this->faker->dateTimeBetween('-30 days','-1 days'),
        ];
    }
}
