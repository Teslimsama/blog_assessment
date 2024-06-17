<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::chunk( 50, function ($blogs)  {
            foreach( $blogs as $blog ) {
                Image::factory()
                    ->count(1)
                        ->create([
                            'imageable_id' => $blog->id,
                            'imageable_type' => get_class( new Blog() )
                        ]);
            }
        });
    }
}
