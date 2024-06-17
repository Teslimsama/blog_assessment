<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_a_comment()
    {

        $user = User::factory()->create();
        $blog = Blog::factory()->create([
            'user_id' => $user->id
        ]);

        // Login as the created user
        $this->actingAs($user);

        $response = $this->post(route('comment.store', ['blog' => $blog->id]), [
            'body' => 'This is a new comment.',
            'user_id' => $user->id
        ]);

        $response->assertStatus(200); // Assuming it redirects after storing
        $this->assertDatabaseHas('comments', [
            'blog_id' => $blog->id,
            'body' => 'This is a new comment.',
        ]);

    }
}
