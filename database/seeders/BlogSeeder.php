<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::limit(100)->chunk(10, function ($users) {
            foreach( $users as $index => $user ) {

                $nextUser =  ( isset( $users[$index + 1] ) ) ? $users[$index+1] : null;

                if ( $nextUser !== null ) {
                    Blog::factory()
                        ->count(5)
                            ->hasComments(10, [
                                'user_id' => $nextUser->id
                            ])
                            ->create([
                                'user_id' => $user->id
                            ]);
                }

            }
        });
    }
}
