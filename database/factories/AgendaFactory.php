<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blog;
use Illuminate\Support\Str;

class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'disposisi_id' => $this->faker->numerify(),
            'jam_agenda' => $this->faker->time(),
            'tanggal_agenda' => $this->faker->dateTimeThisYear(),
            'isi' => $this->faker->sentence(3),
            'tempat' => $this->faker->name,
            'keterangan' => $this->faker->text(10),
        ];
    }
}
