<?php

namespace Database\Factories\Shelter;

use App\Models\User;

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Shelter\Shelter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShelterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shelter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'telephone' => $this->faker->e164PhoneNumber,
            'mobile' => $this->faker->e164PhoneNumber,
            'fax' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'web_address' => $this->faker->url,
            'bank_name' => $this->faker->company,
            'iban' => $this->faker->creditCardNumber,
            'register_date' => $this->faker->date,
            'shelter_code' => $this->faker->word
        ];
    }
}
