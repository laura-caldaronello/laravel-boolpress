<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Post;
use App\Category;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $new_post = new Post();
            $new_post->title = $faker->sentence(rand(4,10));
            $new_post->text = $faker->text(rand(1000,2000));

            $slug = Str::slug($new_post->title,'-');
            $slug_base = $slug;
            $post_presente = Post::where('slug',$slug)->first();
            $contatore = 1;
            while ($post_presente) {
                $slug = $slug_base . '-' . $contatore;
                $contatore++;
                $post_presente = Post::where('slug',$slug)->first();
            }
            $new_post->slug = $slug;

            $new_post->user_id = 1;


            $categories_ids = Category::all()->modelKeys();
            $new_post->category_id = $faker->randomElement($categories_ids); //devo comunuqe lanciare prima il seed categorie

            $new_post->save();
        }
    }
}
