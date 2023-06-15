<?php


namespace App\Http\Controllers\Post;


use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Logger\MyLogger;
use App\Models\Post;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    protected $logger;

    public function __construct(MyLogger $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);

        $record = Post::firstOrCreate($data);
        $recordId = $record->id;

        $currentDateTime = Carbon::now();
        $this->logger->log($currentDateTime . ' : Post is created with id - : ' . $recordId);

        return redirect()->route('post.index');
    }
}
