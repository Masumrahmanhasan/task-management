<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'content' => fake()->paragraph,
            'user_id' => 1,
            'published_at' => now(),
        ];
    }

    public function configure(): Factory|ArticleFactory
    {
        return $this->afterCreating(function (Article $article) {

            $categoryIds = Category::query()->pluck('id')->toArray();
            $randomCategoryIds = fake()->randomElements($categoryIds, fake()->numberBetween(1, count($categoryIds)));
            $article->categories()->attach($randomCategoryIds);
        });
    }
}
