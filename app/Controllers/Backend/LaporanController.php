<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;

class LaporanController extends BaseController
{
    protected $reportModel;

    public function __construct()
    {
        $this->reportModel = new \App\Models\ReportModel();
    }
    public function index()
    {
        $reports = $this->reportModel->findAll();

        return view('backend/laporan/index', [
            'title' => 'Laporan',
            'menu' => 'laporan',
            'reports' => $reports,
        ]);
    }

    public function create()
    {
        return view('backend/laporan/create', [
            'title' => 'Tambah Laporan',
            'menu' => 'laporan'
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
}
