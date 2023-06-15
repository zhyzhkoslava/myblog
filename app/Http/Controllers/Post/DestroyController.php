<?php


namespace App\Http\Controllers\Post;


use App\Http\Controllers\Controller;
use App\Logger\MyLogger;
use App\Models\Post;

class DestroyController extends Controller
{
    protected $logger;

    public function __construct(MyLogger $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Post $post)
    {
        $post->delete();

        $this->logger->log('Post is Deleted!');

        return redirect()->route('post.index');
    }
}
