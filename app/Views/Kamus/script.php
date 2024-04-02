<script>
    function tombol_form_kamus() {
        if ($('#materi').val() != '' && $('#topik').val() != '' && $('#isi').val() != '') {
            $('#submit_tambah').prop('disabled', false);
        } else {
            $('#submit_tambah').prop('disabled', true);
        }
    }

    $(document).ready(function() {
        $('#tambah_kamus').on('click', function() {
            clear_form_kamus();
            tombol_form_kamus();
            $('#submit_tambah').html('Tambah');
            $('#id').val(0);
        });
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
        $('#materi').on('change', function() {
            tombol_form_kamus();
        });
        $('#topik').on('change', function() {
            tombol_form_kamus();
        });
        $('#isi').on('keyup', function() {
            tombol_form_kamus();
        });

        $('#submit_tambah').on('click', function() {
            const id = $('#id').val(),
                materi = $('#materi').val(),
                topik = $('#topik').val(),
                isi = $('#isi').val();
            $.ajax({
                url: method_url('kamus', 'insertedit'),
                data: {
                    id: id,
                    materi: materi,
                    topik: topik,
                    isi: isi,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    $('.konten-kamus').html(data);
                    tampil_flash();
                }
            });
        });
    })
</script>