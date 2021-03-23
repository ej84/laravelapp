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
        return [

            'name' => $this->faker->name,
            'role' => 'freelancer, warrior, magician, healer, vanguard',
            'server name' => 'beta',
            'char_level' => 1,
            'exp amount' => 0,
            'logged in at' => now(),

        ];
    }
}
