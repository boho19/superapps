<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Izin>
 */
class IzinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_karyawan' => 1,
            'keterangan' => 'sakit',
            'alasan' => fake()->sentence(10),
            'mulai' => '2024-07-26',
            'selesai' => '2024-07-29',
        ];
    }
}
