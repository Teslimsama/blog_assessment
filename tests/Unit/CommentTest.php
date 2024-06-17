<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{

     use RefreshDatabase;

    /** @test */
    public function it_can_create_a_comment()
    {

        $user = User::factory()->create();
        $blog = Blog::factory()->create([
            'user_id' => $user->id
        ]);

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'blog_id' => $blog->id,
            'body' => 'This is a test comment.',
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'blog_id' => $blog->id,
            'body' => 'This is a test comment.',
        ]);


    }

    /** @test */
    public function a_comment_belongs_to_a_blog()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create([
            'user_id' => $user->id
        ]);

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'blog_id' => $blog->id,
            'body' => 'This is a test comment.',
        ]);

        $this->assertEquals($blog->id, $comment->blog->id);


    }
}
