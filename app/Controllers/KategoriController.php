<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ThreadModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class KategoriController extends BaseController
{    
    protected $categoryModel, $threadModel, $categoriesModel;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->threadModel = new ThreadModel();
        $this->categoriesModel = new CategoryModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $slug
     * @return void
     */
    public function index($slug)
    {
        $category = $this->categoryModel->where('slug', $slug)->first();

        $categories =  $this->categoryModel->orderBy('RAND()')
            ->join('thread_categories', 'thread_categories.category_id = categories.id')
            ->join('threads', 'threads.id = thread_categories.thread_id')
            ->where('threads.status', 'published')
            ->where('categories.id !=', $category->id)
            ->groupBy('categories.id')
            ->select('categories.*')
            ->findAll(8);

        if (!$category || !$category->threads) throw PageNotFoundException::forPageNotFound();

        $get = $this->request->getVar();
        $orderSelected = (isset($get['order']) && in_array($get['order'], ['desc', 'asc', 'popular'])) ? $get['order'] : 'desc';

        $threads = $this->threadModel->published()
            ->join("thread_categories", "thread_categories.thread_id = threads.id")
            ->where("thread_categories.category_id", $category->id)
            ->groupBy("threads.id")
            ->select("threads.*");

        if ($orderSelected === 'popular') {
            $threads->orderBy('(SELECT COUNT(*) FROM replies WHERE thread_id = threads.id)', 'desc')
                ->orderBy('(SELECT COUNT(*) FROM likes WHERE model_id = threads.id)', 'desc')
                ->orderBy('views', 'desc');
        } else {
            $threads->orderBy('threads.created_at', $orderSelected);
        }

        return view('frontend/kategori/index', [
            'title' => "Kategori $category->name",
            'threads' => $threads->paginate(10, 'category-thread'),
            'pager' => $this->threadModel->pager,
            'category' => $category,
            'order_selected' => $orderSelected,
            'categories' => $categories,
            'slug'  => $slug,
            'category_name' => $category->name, 
        ]);
    }
}
