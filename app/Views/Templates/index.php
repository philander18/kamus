<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Grid</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link href="<?= base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>public/css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container-fluid mt-2 mb-3 text-center">
        <h2 class="cabin-600">Kamus Philander</h2>
    </div>
    <div class="container-fluid mb-2">
        <div class="row">
            <div class="col-12 col-md-5 col-xl-3 order-1">
                <select class="form-select cabin-400 mb-2 bg-form-30 w-100" aria-label="Default select example">
                    <option value="1" selected>Search Topik</option>
                    <option value="2">Search Konten</option>
                </select>
            </div>
            <div class="col-12 col-md-5 col-xl-3 order-2">
                <input class="form-control bg-form-30 mb-2" type="text" placeholder="Keyword" aria-label="default input example">
            </div>
            <div class="col-6 col-md-2 col-xl-1 mb-2 order-md-3 order-0">
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#form_tambah_kamus">Tambah</button>
            </div>
        </div>
    </div>
    <div class="container-fluid container-grid-table">
        <div class="item-3 fw-bold">Materi</div>
        <div class="item-3 fw-bold">Topik</div>
        <div class="item-3 fw-bold">Konten</div>
        <div class="item-3">4</div>
        <div class="item-3">5</div>
        <div class="item-3">6</div>
        <div class="item-3">7</div>
        <div class="item-3">8</div>
        <div class="item-3">9</div>
    </div>
    <div class="modal fade" id="form_tambah_kamus" tabindex="-1" aria-labelledby="Form Tambah" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 cabin-700" id="judul_tambah">Tambah Kamus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cabin-700" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary cabin-700">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url(); ?>public/js/bootstrap.min.js"></script>
</body>

</html>