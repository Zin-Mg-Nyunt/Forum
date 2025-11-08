<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Thread;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Thread::factory(10)->create();

        $tags = [
            [
                "name"=>"vue",
                "slug"=>"vue"
            ],
            [
                "name"=>"laravel",
                "slug"=>"laravel"
            ],
            [
                "name"=>"javascript",
                "slug"=>"javascript"
            ],
            [
                "name"=>"css",
                "slug"=>"css"
            ],
            [
                "name"=>"php",
                "slug"=>"php"
            ],
            [
                "name"=>"html",
                "slug"=>"html"
            ],
        ];

        foreach ($tags as $tag) {
            Tag::factory()->create([
                'name'=>$tag['name'],
                'slug'=>$tag['slug']
            ]);
        }

        $categories = [
            [
                "name"=>"General",
                "slug"=>"general"
            ],
            [
                "name"=>"Announcements",
                "slug"=>"announcements"
            ],
            [
                "name"=>"Knowledge",
                "slug"=>"knowledge"
            ],
            [
                "name"=>"Events",
                "slug"=>"events"
            ],
            [
                "name"=>"Help",
                "slug"=>"help"
            ],
        ];

        foreach ($categories as $category) {
            Category::factory()->create([
                'name'=>$category['name'],
                'slug'=>$category['slug']
            ]);
        }
    }
}
