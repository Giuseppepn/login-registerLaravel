<?php

namespace Database\Factories;
use App\Models\Utente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utente>
 */
class UtenteFactory extends Factory
{
    /**
     *
     * @var string
     */

     protected $model= Utente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition(): array
    {
        return [
           'username' => $this->faker->name(),
           'email' => $this->faker->email(),
           'password' => $this->faker->password(),
        ];
    }
}
