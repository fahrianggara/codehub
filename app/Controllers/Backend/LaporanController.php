<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\ReportModel;
use App\Models\UserModel;
use Config\Database;

class LaporanController extends BaseController
{
    protected $reportModel, $userModel, $db;
    
    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->reportModel = new ReportModel();
        $this->userModel = new UserModel();
        $this->db = Database::connect();
    }  
    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        // Membuat kueri kustom untuk pengelompokan berdasarkan beberapa kolom
        $customQuery = $this->reportModel->query("
            SELECT MIN(id) as id, model_id, model_class, user_id, message, COUNT(*) as count
            FROM reports
            GROUP BY model_id, model_class, user_id, message
            ORDER BY model_id ASC, model_class ASC, count DESC
        ");

        // Mendapatkan hasil dari kueri kustom
        $reports = $customQuery->getResult();

        return view('backend/laporan/index', [
            'title' => 'Laporan Diskusi',
            'menu' => 'laporan',
            'reports' => $reports,
        ]);
    }

    /**
     * Destroy the specified resource in storage.
     * 
     * @return void
     */
    public function destroy()
    {
        $post = $this->request->getPost();

        $this->db->transBegin();
        try {
            $id = decrypt($post['id']);

            $model = $this->reportModel->where('id', $id)->first();
            
            $this->reportModel->where('model_id', $model->model_id)
                ->where('model_class', $model->model_class)
                ->where('user_id', $model->user_id)
                ->where('message', $model->message)
                ->delete();

            session()->setFlashdata('success', 'Laporan berhasil dihapus.');

            return response()->setJSON([
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            $this->db->transRollback();

            return response()->setJSON([
                'status' => 400,
                'message' => $th->getMessage()
            ]);
        } finally {
            $this->db->transCommit();
        }
    }
    
    /**
     * Show the specified resource.
     *
     * @return void
     */
    public function objectShow()
    {
        $post = $this->request->getPost();

        $model_id = $post['model_id'];
        $model_class = new $post['model_class']; // new App\Models\ThreadModel or new App\Models\ReplyModel
        $model = $model_class->find($model_id);

        $data = [
            'user_id' => encrypt($model->user_id),
            'content' => $model->content,
            'author' => $model->user->full_name,
            'date' => ago($model->created_at),
        ];

        return response()->setJSON([
            'status' => 200,
            'data' => $data,
        ]);
    }

    /**
     * Destroy the specified resource in storage.
     * 
     * @return void
     */
    public function objectDestroy()
    {
        $post = $this->request->getPost();

        $this->db->transBegin();
        try {
            if (isset($post['user_id'])) { // Hapus Author
                $user_id = decrypt($post['user_id']);
                $user = $this->userModel->find($user_id);

                deleteImage("images/avatars", $user->avatar); // hapus avatar
                deleteImage("images/banners", $user->banner); // hapus banner

                $this->reportModel->where('user_id', $user_id)->delete();
                $this->userModel->delete($user_id);

                session()->setFlashdata('success', 'Author dari objek berhasil dihapus.');
                
                return response()->setJSON([
                    'status' => 200,
                ]);
            } else { // Hapus Thread atau Reply
                $model_id = $post['model_id'];
                $model_class = $post['model_class']; // new App\Models\ThreadModel or new App\Models\ReplyModel
                $model = (new $model_class)->find($model_id);

                $this->reportModel->where('model_id', $model_id)
                    ->where('model_class', $model_class)
                    ->delete();

                if ($model->likes) {
                    $this->db->table('likes')
                        ->where('model_id', $model_id)
                        ->where('model_class', $model_class)
                        ->delete();
                }

                (new $model_class)->where('id', $model_id)->delete();
                
                session()->setFlashdata('success', 'Objek berhasil dihapus.');

                return response()->setJSON([
                    'status' => 200,
                ]);
            }
        } catch (\Throwable $th) {
            $this->db->transRollback();

            return response()->setJSON([
                'status' => 400,
                'message' => $th->getMessage()
            ]);
        } finally {
            $this->db->transCommit();
        }
    }
}
