<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
  public function definition(): array
  {
    $categories = ['Alat Ukur', 'Alat Bantu', 'Peralatan Medis', 'Perlengkapan Rumah Sakit'];

    return [
      'name' => fake()->words(3, true),
      'description' => fake()->paragraph(),
      'price' => fake()->numberBetween(100000, 10000000),
      'image' => 'https://source.unsplash.com/400x300/?medical,equipment',
      'stock' => fake()->numberBetween(0, 100),
      'category' => fake()->randomElement($categories),
    ];
  }
}
