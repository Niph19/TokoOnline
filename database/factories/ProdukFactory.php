<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_produk' => fake()->words(3, true),
            'harga' => fake()->numberBetween(10000, 5000000),
            'stok' => fake()->numberBetween(0, 100),
            'deskripsi' => fake()->sentence(12),
            'image' => 'products/'.fake()->unique()->slug().'.jpg',
        ];
    }
}
