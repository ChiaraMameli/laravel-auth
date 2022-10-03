<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


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
        $users_id = User::pluck('id')->toArray();
        $tags_id = Tag::pluck('id', 'color_tag', 'color')->toArray();

        for($i = 0; $i < 10; $i++){
            $new_post = new Post();

            $new_post->title = $faker->text(30);
            $new_post->slug = Str::slug($new_post->title, '-');
            $new_post->category_id = Arr::random($categories_id);
            $new_post->user_id = Arr::random($users_id);
            $new_post->content = $faker->paragraphs(2, true);
            $new_post->image = $faker->imageUrl(400, 400);

            $new_post->save();

            $post_tags = [];

            foreach($tags_id as $tag_id){
                if($faker->boolean()) $post_tags[] = $tag_id;
            }

            $new_post->tags()->attach($post_tags);
        }
    }
}
