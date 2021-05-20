<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 3; $i++) {
            $new_category = new Category();

            $new_category->name = $faker->sentence(rand(1,5));

            $slug = Str::slug($new_category->name,'-');
            $slug_base = $slug;
            $category_presente = Category::where('slug',$slug)->first();
            $contatore = 1;
            while ($category_presente) {
                $slug = $slug_base . '-' . $contatore;
                $contatore++;
                $category_presente = Category::where('slug',$slug)->first();
            }
            $new_category->slug = $slug;

            $new_category->save();
        }
    }
}
