<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_blogs_index_page()
    {
        $response = $this->get(route('blog.index'));
        $response->assertStatus(302);
    }

    /** @test */
    public function it_displays_a_single_blog()
    {

        $user = User::factory()->create();
        $blog = Blog::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->get(route('blog.show', ['blog' => $blog->id]));

        $response->assertStatus(200);
        $response->assertViewIs('blog.show', ['blog' => $blog->id]);
        $response->assertSee($blog->title);
        $response->assertSee($blog->content);
    }
}
