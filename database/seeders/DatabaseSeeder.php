<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        // User::factory()->withPersonalTeam()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory()->withPersonalTeam()->create([
            'name' => 'Krzysztof',
            'email' => 'kpiechowski25@gmail.com',
        ]);




        $rootCategories = ProductCategory::factory()->count(5)->create();
        $bottomCategories = new Collection();

        $rootCategories->each(function ($category) use ($bottomCategories){
            $children = ProductCategory::factory()->count(3)->create([
                'parent_id' => $category->id,
            ]);

            $children->each(function ($child) use ($bottomCategories) {
                $bottomCategories->push(...ProductCategory::factory()->count(2)->create([
                    'parent_id' => $child->id,
                ]));
            });
        });



        $products = Product::factory(30)->create()->each(function (Product $product) use ($bottomCategories) {
            // $imageUrl = "https://picsum.photos/200";
            // $imageContent = Http::get($imageUrl)->body();
            // $imageName = 'products/' . $product->id . '.jpg';

            // Storage::put($imageName, $imageContent);
            // $product->featured_image = $imageName;
            $product->productCategory()->save($bottomCategories->random());
            
        });

        
    }
}
