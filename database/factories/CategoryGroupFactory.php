<?php

namespace Database\Factories;

use App\Models\CategoryGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryGroupFactory extends Factory
{
    protected $model = CategoryGroup::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'category_ids' => [1, 2, 3], // Nếu dùng cast array
        ];
    }
}
