<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ThreadModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class SearchController extends BaseController
{    
    protected $threadModel;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->threadModel = new ThreadModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $get = $this->request->getVar();
        $currQuery = isset($get['q']) ? htmlspecialchars($get['q']) : '';

        if (!$currQuery) return redirect()->back()->with('info', 'Kata kunci pencarian tidak boleh kosong!');

        $orderSelected = (isset($get['order']) && in_array($get['order'], ['desc', 'asc', 'popular'])) ? $get['order'] : 'desc';

        $threads = $this->threadModel->published()->like('title', $currQuery);

        if ($orderSelected === 'popular') {
            $threads->orderBy('(SELECT COUNT(*) FROM replies WHERE thread_id = threads.id)', 'desc')
                ->orderBy('(SELECT COUNT(*) FROM likes WHERE model_id = threads.id)', 'desc')
                ->orderBy('views', 'desc');
        } else {
            $threads->orderBy('threads.created_at', $orderSelected);
        }

        return view('frontend/search/index', [
            'title' => "Pencarian: {$currQuery}",
            'threads' => $threads->paginate(10, 'search-thread'),
            'pager' => $this->threadModel->pager,
            'query' => $currQuery,
            'order_selected' => $orderSelected,
        ]);
    }
}
