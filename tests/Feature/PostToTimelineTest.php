<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostToTimelineTest extends TestCase
{   
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_a_user_can_post_a_text_post(): void
    {   
        $this->withoutExceptionHandling();
        $this->actingAs($user = (User::factory())->create(), 'api');
        $response = $this->post('/api/posts', [
            'data' => [
                'type' => 'posts',
                'attributes' => [
                    'body' => 'Testing body'
                ]
            ]
        ]);

        $post = Post::first();

        $this->assertCount(1, Post::all());
        $this->assertEquals($user->id, $post->user_id);
        $this->assertEquals('Testing body', $post->body);
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'posts', 
                    'post_id' => $post->id,
                    'attributes' => [
                        'body' => 'Testing body',
                    ]
                ],
                'links' => [
                    'self' => url('/posts', $post->id),

                ] 
            ]);
    }
}
