<?php

namespace App\Models;

use App\Entities\Category;
use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $returnType       = Category::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = [
        'name', 'slug', 'cover'
    ];

    public function getTopCategories($limit = 3)
    {
        $categories = $this->findAll();
        $kategoriJumlahThreads = [];

        foreach ($categories as $category) {
            $jumlahThreads = count($category->getThreads());
            $kategoriJumlahThreads[$category->id] = $jumlahThreads;
        }

        // Mengurutkan kategori berdasarkan jumlah threads secara descending
        arsort($kategoriJumlahThreads);

        $topCategories = [];

        // Mengambil tiga kategori teratas
        $slicedCategories = array_slice($kategoriJumlahThreads, 0, $limit, true);

        foreach ($slicedCategories as $kategoriId => $jumlahThreads) {
            $category = $this->find($kategoriId);
            $topCategories[] = $category;
        }

        return $topCategories;
    }
}
