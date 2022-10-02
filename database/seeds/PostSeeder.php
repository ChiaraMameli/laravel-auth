<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker, Category $category)
    {
        $categories_id = Category::pluck('id')->toArray();

        for($i = 0; $i < 10; $i++){
            $new_post = new Post();

            $new_post->title = $faker->text(30);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->user_id = 1;
            $new_post->category_id = Arr::random($categories_id);
            $new_post->content = $faker->paragraphs(2, true);
            $new_post->image = $faker->imageUrl(400, 400);

            $new_post->save();
        }
    }
}
