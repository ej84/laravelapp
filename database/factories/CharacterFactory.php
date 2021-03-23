<?php


namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CharacterFactory extends Factory
{
    protected $model = Character::class;

    public function definition()
    {
        try {
            return [

                'name' => $this->faker->name,
                'role' => 'freelancer, warrior, magician, healer, vanguard, defender, bishop',
                'server name' => 'beta',
                'char_level' => random_int(1, 50),
                'exp amount' => random_int(0, 100000),
                'logged in at' => now(),

            ];
        } catch (\Exception $e) {
        }
    }
}
