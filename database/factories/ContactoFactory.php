<?php

namespace Database\Factories;

use App\Models\Contacto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContactoFactory extends Factory
{
    protected $model = Contacto::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'apellido' => $this->faker->name,
			'edad' => $this->faker->name,
			'cumpleaños' => $this->faker->name,
			'direccion' => $this->faker->name,
			'telefono' => $this->faker->name,
        ];
    }
}
