<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{

     use RefreshDatabase;

    /** @test */
    public function it_can_create_a_blog()
    {

        $user = User::factory()->create();
        $blog = Blog::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Blog',
            'body' => 'This is the content of the test blog post.',
        ]);

        $this->assertDatabaseHas('blogs', [
            'title' => 'Test Blog',
            'user_id' => $user->id,
            'body' => 'This is the content of the test blog post.',
        ]);

    }

    /** @test */
    public function a_blog_has_many_comments()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create([
            'user_id' => $user->id
        ]);

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'body' => 'This is a comment.',
            'blog_id' => $blog->id
        ]);

        $this->assertTrue($blog->comments->contains($comment));
    }
}
