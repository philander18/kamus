<?= $this->extend('Templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid mt-2 mb-3 text-center">
    <h2 class="cabin-600">Kamus Philander</h2>
</div>
<div class="container-fluid mb-2">
    <div class="row">
        <div class="flash">
        </div>
        <div class="col-12 col-md-5 col-xl-3 order-1">
            <select class="form-select cabin-400 mb-2 bg-form-30 w-100" id="jenis_search" aria-label="Default select example">
                <option value="1" selected>Search Topik</option>
                <option value="2">Search Konten</option>
            </select>
        </div>
        <div class="col-12 col-md-5 col-xl-3 order-2">
            <input class="form-control bg-form-30 mb-2" type="text" id="keyword" placeholder="Keyword" aria-label="default input example">
        </div>
        <div class="col-6 col-md-2 col-xl-1 mb-2 order-md-3 order-0">
            <button type="button" class="btn btn-primary w-100" id="tambah_kamus" data-bs-toggle="modal" data-bs-target="#form_kamus">Tambah</button>
        </div>
    </div>
</div>
<div class="container-fluid konten-kamus">
    <div class="container-grid-table judul-label cabin-700">
        <div class="item-3 fw-bold">Materi</div>
        <div class="item-3 fw-bold">Topik</div>
        <div class="item-3 fw-bold">Konten</div>
    </div>
    <?php foreach ($kamus as $row) : ?>
        <div class="container-grid-table">
            <div class="item-3 fw-bold cabin-700">
                <?= $row['materi']; ?>
            </div>
            <div class="item-3 cabin-500">
                <a href="" class="edit_kamus" data-id="<?= $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#form_kamus">
                    <?= $row['topik']; ?>
                </a>
            </div>
            <div class="item-3 cabin-400">
                <?php
                $text = "";
                foreach (preg_split("/\r\n|\n|\r/", $row["isi"]) as $list) : {
                        $part = str_replace('<', '&lt;', $list);
                        $part = str_replace('>', '&gt;', $part);
                        $part = $part . "<br>";
                        $text .= $part;
                    }
                endforeach;
                ?>
                <?= $text; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if ($kamus) : ?>
        <div class="page cabin-500">
            <ul>
                <?php if ($pagination['first']) : ?>
                    <li><a href="#" class="linkP" id="first" name="first" data-page="1">First</a></li>
                <?php endif ?>
                <?php if ($pagination['previous']) : ?>
                    <li><a href="#" class="linkP" id="previous" name="previous" data-page="<?= $page - 1; ?>">Prev</a></li>
                <?php endif ?>
                <?php foreach ($pagination['number'] as $number) : ?>
                    <li><a href="#" class="linkP <?= $pagination['page'] == $number ? 'text-primary' : '' ?>" id="nomor<?= $number; ?>" name="nomor<?= $number; ?>" data-page="<?= $number; ?>"><?= $number; ?></a></li>
                <?php endforeach ?>
                <?php if ($pagination['next']) : ?>
                    <li><a href="#" class="linkP" id="next" name="next" data-page="<?= $page + 1; ?>">Next</a></li>
                <?php endif ?>
                <?php if ($pagination['last']) : ?>
                    <li><a href="#" class="linkP" id="last" name="last" data-page="<?= $last; ?>">Last</a></li>
                <?php endif ?>
            </ul>
        </div>
    <?php endif ?>
</div>
<div class="modal fade" id="form_kamus" tabindex="-1" aria-labelledby="Form Tambah" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 cabin-700" id="judul_tambah">Tambah Kamus</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id" value="">
                <div class="form-modal">
                    <label for="materi" class="form-label cabin-600">Materi</label>
                    <input class="form-control" type="text" id="materi" name="materi" placeholder="Materi" aria-label="default input example">
                </div>
                <div class="form-modal">
                    <label for="topik" class="form-label cabin-600">Topik</label>
                    <input class="form-control" type="text" id="topik" name="topik" placeholder="Topik" aria-label="default input example">
                </div>
                <div class="form-modal">
                    <label for="isi" class="form-label cabin-600">Isi</label>
                    <textarea class="form-control" id="isi" name="isi" placeholder="Isi" id="isi" rows="4"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cabin-700" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary cabin-700" id="submit_tambah" data-bs-dismiss="modal">Tambah</button>
                <button type="button" class="btn btn-primary cabin-700" id="hapus_kamus" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#konfirmasi">Hapus</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="konfirmasi" tabindex="-1" aria-labelledby="konfirmasi" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-primary" id="konfirmasi_hapus">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding-top:2px;">
                <div class="form-group">
                    <label class="text-dark fw-bold ms-2 mb-2 cabin-600">Yakin dihapus?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cabin-700" data-bs-dismiss="modal">TIDAK</button>
                <button type="button" id="ya_hapus" class="btn btn-primary hapus cabin-700" data-bs-dismiss="modal">YA</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>