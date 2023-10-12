<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $minLat = -17.835919;
        $maxLat = -17.755830;

        $minLon = -63.202621;
        $maxLon = -63.125030;

        $randomNumber = mt_rand() / mt_getrandmax();
        $randomLat = $minLat + ($randomNumber * ($maxLat - $minLat));
        $randomLon = $minLon + ($randomNumber * ($maxLon - $minLon));
        return [
            'ci' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'ap_paterno' => $this->faker->lastName,
            'ap_materno' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'ubicacion' => $this->faker->address,
            'latitud' => round($randomLat, 6),
            'longitud' => round($randomLon, 6),
            'genero' => $this->faker->randomElement(['M', 'F']),
            'fecha_nac' => $this->faker->date,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Puedes cambiar 'password' por la contraseña deseada
            'remember_token' => Str::random(10),
            'remember_token' => Str::random(10),
            'created_at' => mt_rand(strtotime('10/01/2014'), strtotime('10/01/2019'))
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('Paciente');
        });
    }
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (!Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name . '\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
