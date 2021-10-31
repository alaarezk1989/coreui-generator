<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Advertisement::factory(10)->create();
        \App\Models\Menu::factory(10)->create();
        \App\Models\Slider::factory(10)->create();
    }
}
