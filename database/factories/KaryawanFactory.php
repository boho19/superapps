<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => strval(fake()->randomNumber(9, true)),
            'nama' => fake()->name('male'),
            'jenis_kelamin' => 'LK',
            'no_hp' => fake()->e164PhoneNumber(),
            'alamat' => fake()->streetAddress(),
            'provinsi' => fake()->sentence(1),
            'jabatan' => fake()->sentence(1),
            'foto' => 'blank.jpg',
            'id_user' => User::factory(),
        ];
    }
}
