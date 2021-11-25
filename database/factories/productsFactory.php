<?php

namespace Database\Factories;

// @var $factory;
use Illuminate\Database\Eloquent\Factories\Factory as factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\products;

class productsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
   
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            return [
                // 'id' => $this->faker->id,
                'c_id' => $this->faker->rand(10,200),
                'p_name' => $this->faker->name,
                'p_sku' => $this->faker->city,
                'p_tags' => $this->faker->firstNameMale,
                'p_description' => $this->faker->lastName,
                'p_image' => $this->faker->image($dir = '/tmp', $width = 640, $height = 480),
                'p_stock' => rand(1,1000),
                'p_price' => $this->faker->numberBetween($min = 1000, $max = 9000),
            ];
    }
}
