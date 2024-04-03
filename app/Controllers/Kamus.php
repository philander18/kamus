<?php

namespace App\Controllers;

use App\Models\KamusModel;
use DateTime;

class Kamus extends BaseController
{
    protected $KamusModel;
    protected $jumlahlist = 10;
    public function __construct()
    {
        $this->KamusModel = new KamusModel();
    }
    public function index()
    {
        $jumlahdata = count($this->KamusModel->findAll());
        $lastpage = ceil($jumlahdata / $this->jumlahlist);
        $all = $this->KamusModel->orderBy('materi', 'ASC')->findAll();
        $tabel = array_splice($all, 0);
        array_splice($tabel, $this->jumlahlist);
        $pagination = $this->pagination(1, $lastpage);
        $data = [
            'judul' => 'Kamus',
            'kamus' => $tabel,
            'jumlah' => $jumlahdata,
            'last' => $lastpage,
            'pagination' => $pagination,
            'page' => 1
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
        $jumlahdata = count($this->KamusModel->findAll());
        $lastpage = ceil($jumlahdata / $this->jumlahlist);
        $all = $this->KamusModel->orderBy('materi', 'ASC')->findAll();
        $tabel = array_splice($all, 0);
        array_splice($tabel, $this->jumlahlist);
        $pagination = $this->pagination(1, $lastpage);
        $data = [
            'kamus' => $tabel,
            'jumlah' => $jumlahdata,
            'last' => $lastpage,
            'pagination' => $pagination,
            'page' => 1
        ];
        return view('Kamus/Konten/index', $data);
    }
    public function get_kamus()
    {
        echo json_encode($this->KamusModel->where('id', $_POST['id'])->findAll()[0]);
    }
    public function delete_kamus()
    {
        if ($this->KamusModel->where('id', $_POST['id'])->delete()) {
            session()->setFlashdata('pesan', 'Hapus kamus berhasil.');
        } else {
            session()->setFlashdata('pesan', 'Update kamus gagal.');
        }
        $jumlahdata = count($this->KamusModel->findAll());
        $lastpage = ceil($jumlahdata / $this->jumlahlist);
        $all = $this->KamusModel->orderBy('materi', 'ASC')->findAll();
        $tabel = array_splice($all, 0);
        array_splice($tabel, $this->jumlahlist);
        $pagination = $this->pagination(1, $lastpage);
        $data = [
            'kamus' => $tabel,
            'jumlah' => $jumlahdata,
            'last' => $lastpage,
            'pagination' => $pagination,
            'page' => 1
        ];
        return view('Kamus/Konten/index', $data);
    }
    public function search_kamus()
    {
        $keyword = $_POST['keyword'];
        $index = ($_POST['page'] - 1) * $this->jumlahlist;
        if ($_POST['jenis'] == 1) {
            $where = "materi like '%" . $keyword . "%' or topik like '%" . $keyword . "%'";
        } else {
            $where = "isi like '%" . $keyword . "%'";
        }
        $all = $this->KamusModel->where($where)->orderBy('materi', 'ASC')->findAll();
        $jumlahdata = count($all);
        $lastpage = ceil($jumlahdata / $this->jumlahlist);
        $tabel = array_splice($all, $index);
        array_splice($tabel, $this->jumlahlist);
        $pagination = $this->pagination($_POST['page'], $lastpage);
        $data = [
            'kamus' => $tabel,
            'jumlah' => $jumlahdata,
            'last' => $lastpage,
            'pagination' => $pagination,
            'page' => $_POST['page']
        ];
        return view('Kamus/Konten/index', $data);
    }
    public function pagination($page, $lastpage)
    {
        $pagination = [
            'first' => false,
            'previous' => false,
            'next' => false,
            'last' => false
        ];
        if ($lastpage == 1) {
            $pagination['number'] = [1];
        } elseif ($lastpage == 2) {
            $pagination['number'] = [1, 2];
        } elseif ($lastpage == 3) {
            $pagination['number'] = [1, 2, 3];
        } elseif ($lastpage == 4) {
            $pagination['number'] = [1, 2, 3, 4];
        } elseif ($lastpage == 5) {
            $pagination['number'] = [1, 2, 3, 4, 5];
        } else {
            if ($page >= 1 and $page <= 3) {
                $pagination['next'] = true;
                $pagination['last'] = true;
                $pagination['number'] = [1, 2, 3];
            } elseif ($page >= $lastpage - 2 and $page <= $lastpage) {
                $pagination['first'] = true;
                $pagination['previous'] = true;
                $pagination['number'] = [$lastpage - 2, $lastpage - 1, $lastpage];
            } else {
                $pagination['first'] = true;
                $pagination['previous'] = true;
                $pagination['next'] = true;
                $pagination['last'] = true;
                $pagination['number'] = [$page];
            }
        };
        $pagination['page'] = $page;
        return $pagination;
    }
}
