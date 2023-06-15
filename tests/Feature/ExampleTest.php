<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_can_be_stored()
    {
        $this->withExceptionHandling();

        Storage::fake('local');

        $file = File::create('myfile.jpeg');
        $file2 = File::create('myfile2.jpeg');

        $data = [
            'title'          => 'testTitle',
            'content'        => 'testContent',
            'preview_image'  => $file,
            'main_image'     => $file2,
        ];

        $res = $this->post('/posts', $data);

        $res->assertRedirect();

        $this->assertDatabaseCount('posts', 1);

        $post = Post::first();

        $this->assertEquals($data['title'], $post->title);
        $this->assertEquals($data['content'], $post->content);
        $this->assertEquals('images/' . $file->hashName(), $post->preview_image);
        $this->assertEquals('images/' . $file2->hashName(), $post->main_image);
    }
}
