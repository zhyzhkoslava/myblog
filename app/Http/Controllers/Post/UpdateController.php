<?php


namespace App\Http\Controllers\Post;


use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdateRequest;
use App\Logger\MyLogger;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    protected $logger;

    public function __construct(MyLogger $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        if (array_key_exists('preview_image', $data)){
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
        }

        $post->update($data);

        $this->logger->log('Post is Updated!');

        return view('post.show', compact('post'));
    }
}
