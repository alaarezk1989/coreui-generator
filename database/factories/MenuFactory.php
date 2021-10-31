<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent = Menu::all();
        return [
            'language_id' => $this->faker->numberBetween(1, 2),
            'translation_id' =>  $parent->isEmpty() ? null : $parent->randomElement($parent)->id,
            'parent_id' =>  $parent->isEmpty() ? null : $parent->randomElement($parent)->id,
            'title' => $this->faker->text(20),
            'link' => $this->faker->url(),
            'type' => $this->faker->boolean,
            'status' => $this->faker->boolean,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
            ];
    }
}
