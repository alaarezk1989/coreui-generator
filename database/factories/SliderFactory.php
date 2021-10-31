<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent = Slider::all();

        return [
            'language_id' => $this->faker->numberBetween(1, 2),
            'translation_id' =>  $parent->isEmpty() ? null : $parent->randomElement($parent)->id,
            'image_id' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'title' => $this->faker->text(20),
            'description' => $this->faker->text(200),
            'button_link' => $this->faker->url(),
            'button_title' => $this->faker->text(20),
            'status' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
