<?php

namespace App\Controllers;

use App\Models\KamusModel;
use DateTime;

class Kamus extends BaseController
{
    protected $KamusModel;
    public function __construct()
    {
        $this->KamusModel = new KamusModel();
    }
    public function index()
    {
        $data = [
            'judul' => 'Kamus',
            'kamus' => $this->KamusModel->findAll()
        ];
        return view('Kamus/index', $data);
    }
    public function flash()
    {
        return view('Templates/flash');
    }
    public function insertedit()
    {
        $date = new DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $data = [
            'materi' => $_POST['materi'],
            'topik' => $_POST['topik'],
            'isi' => $_POST['isi'],
            'updated_at' => $date
        ];
        if ($_POST['id'] == 0) {
            if ($this->KamusModel->insert($data)) {
                session()->setFlashdata('pesan', 'Tambah kamus   ' . $_POST['topik'] . ' Berhasil.');
            } else {
                session()->setFlashdata('pesan', 'Tambah kamus  ' . $_POST['topik'] . ' Gagal.');
            }
        } else {
            if ($this->KamusModel->update($_POST['id'], $data)) {
                session()->setFlashdata('pesan', 'Update kamus   ' . $_POST['topik'] . ' Berhasil.');
            } else {
                session()->setFlashdata('pesan', 'Update kamus  ' . $_POST['topik'] . ' Gagal.');
            }
        }
        $data = [
            'kamus' => $this->KamusModel->findAll()
        ];
        return view('Kamus/Konten/index', $data);
    }
    public function get_kamus()
    {
        echo json_encode($this->KamusModel->where('id', $_POST['id'])->findAll()[0]);
    }
    public function search_kamus()
    {
        $keyword = $_POST['keyword'];
        if ($_POST['jenis'] == 1) {
            $where = "materi like '%" . $keyword . "%' or topik like '%" . $keyword . "%'";
        } else {
            $where = "isi like '%" . $keyword . "%'";
        }
        $data = [
            'kamus' => $this->KamusModel->where($where)->orderBy('materi', 'ASC')->findAll()
        ];
        return view('Kamus/Konten/index', $data);
    }
}
