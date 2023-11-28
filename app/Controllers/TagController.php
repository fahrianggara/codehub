<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TagModel;
use App\Models\ThreadModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class TagController extends BaseController
{    
    protected $tagModel, $threadModel;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->tagModel = new TagModel();
        $this->threadModel = new ThreadModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $slug
     * @return void
     */
    public function index($slug)
    {
        $tag = $this->tagModel->where('slug', $slug)->first();

        if (!$tag || !$tag->threads) throw PageNotFoundException::forPageNotFound();

        $get = $this->request->getVar();
        $orderSelected = (isset($get['order']) && in_array($get['order'], ['desc', 'asc', 'popular'])) ? $get['order'] : 'desc';

        $threads = $this->threadModel->published()
            ->join("thread_tags", "thread_tags.thread_id = threads.id")
            ->where("thread_tags.tag_id", $tag->id)
            ->groupBy("threads.id")
            ->select("threads.*");

        if ($orderSelected === 'popular') {
            $threads->orderBy('(SELECT COUNT(*) FROM replies WHERE thread_id = threads.id)', 'desc')
                ->orderBy('(SELECT COUNT(*) FROM likes WHERE model_id = threads.id)', 'desc')
                ->orderBy('views', 'desc');
        } else {
            $threads->orderBy('threads.created_at', $orderSelected);
        }

        return view('frontend/tag/index', [
            'title' => "#$tag->name",
            'threads' => $threads->paginate(10, 'tag-thread'),
            'pager' => $this->threadModel->pager,
            'tag' => $tag,
            'order_selected' => $orderSelected,
        ]);
    }
}
