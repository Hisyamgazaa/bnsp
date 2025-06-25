<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // Seed categories first
    $this->call([
      CategorySeeder::class,
    ]);

    // Create admin user
    User::factory()->create([
      'name' => 'Admin User',
      'email' => 'admin@example.com',
      'role' => 'admin',
    ]);

    // Create regular user
    User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
      'role' => 'user',
    ]);

    // Product::factory(10)->create();

  }
}
