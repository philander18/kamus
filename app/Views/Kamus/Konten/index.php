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
<script>
    $(document).ready(function() {
        $('.edit_kamus').on('click', function() {
            clear_form_kamus();
            $('#id').val($(this).data('id'));
            $.ajax({
                url: method_url('kamus', 'get_kamus'),
                data: {
                    id: $(this).data('id'),
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#materi').val(data.materi);
                    $('#topik').val(data.topik);
                    $('#isi').val(data.isi);
                    tombol_form_kamus();
                    $('#submit_tambah').html('Update');
                    $('#judul_tambah').html('Update Kamus');
                    $('#hapus_kamus').prop('hidden', false);
                }
            });
        });
        $('.linkP').on('click', function() {
            search($(this).data('page'));
        });
    })
</script>