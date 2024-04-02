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
                    $part = $list . "<br>";
                    $text .= $part;
                }
            endforeach;
            ?>
            <?= $text; ?>
        </div>
    </div>
<?php endforeach; ?>
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
                }
            });
        });
    })
</script>