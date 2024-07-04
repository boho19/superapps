<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absen>
 */
class AbsenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_karyawan'=> 1,
            'bukti' => 'blank.jpg',
            'latitude' => '-1.1111111122222222',
            'longitude' => '1.1111111122222222',
            'jarak' => '59.111122222222',
            'waktu' => $this->faker->dateTime(),
            'status' => 'tertunda',
        ];
    }
}
