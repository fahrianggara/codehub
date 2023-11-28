<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\ReportModel;
use App\Models\UserModel;

class LaporanController extends BaseController
{
    protected $reportModel;
    protected $userModel;

    public function __construct()
    {
        $this->reportModel = new \App\Models\ReportModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $reports = $this->reportModel->findAll();

        return view('backend/laporan/index', [
            'title' => 'Laporan',
            'menu' => 'laporan',
            'reports' => $reports,
            'reportModel' => $this->reportModel,
            'userModel' => $this->userModel,
        ]);
    }

    public function edit($id)
    {
        $report = $this->reportModel->find(base64_decode($id));

        return view('backend/laporan/edit', [
            'title' => 'Edit Laporan',
            'menu' => 'laporan',
            'user' => $report,
        ]);
    }
    /**
     * Update the specified resource in storage.
     * 
     * @return void
     */

    public function destroy()
    {

        $this->db->transBegin();
        try {
            $id = base64_decode(request()->getVar('id'));
            $report = $this->reportModel->find($id);

            $this->reportModel->delete($id); // hapus user

            return response()->setJSON([
                'status' => 200,
                'message' => 'Data pengguna berhasil dihapus.'
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

    public function reportDiskusi()
    {
        $reportModel = new ReportModel();

        $data = [
            'message' => $this->request->getPost('message'),
            'user_id' => $this->request->getPost('user_id'),
            'model_id' => $this->request->getPost('model_id'),
            'model_class' => $this->request->getPost('model_class'),
        ];

        $reportModel->saveReport($data);

        // Tambahkan logika untuk menampilkan pesan sukses atau gagal
    }

    public function showReport($id)
    {
        $report = $this->reportModel->getReportsWithUserDetails($id);

        return view('backend/laporan/index', ['laporan' => $report]);
    }
}
