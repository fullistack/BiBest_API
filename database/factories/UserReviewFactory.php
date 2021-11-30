<?php

namespace Database\Factories;

use App\Models\Language;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lgs_code = Language::all()->map(function (Language $language){
            return $language->code;
        })->values()->toArray();

        return [
            "review" => $this->faker->realText(rand(20,250)),
            "language_code" => $this->faker->randomElement($lgs_code),
        ];
    }
}
