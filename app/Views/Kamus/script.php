<script>
    function tombol_form_kamus() {
        if ($('#materi').val() != '' && $('#topik').val() != '' && $('#isi').val() != '') {
            $('#submit_tambah').prop('disabled', false);
        } else {
            $('#submit_tambah').prop('disabled', true);
        }
    }

    function search(halaman) {
        const jenis = $('#jenis_search').val(),
            keyword = $('#keyword').val(),
            page = halaman;
        $.ajax({
            url: method_url('Kamus', 'search_kamus'),
            data: {
                keyword: keyword,
                jenis: jenis,
                page: page
            },
            method: 'post',
            dataType: 'html',
            success: function(data) {
                $('.konten-kamus').html(data);
            }
        });
    }

    $(document).ready(function() {
        $('#tambah_kamus').on('click', function() {
            clear_form_kamus();
            tombol_form_kamus();
            $('#submit_tambah').html('Tambah');
            $('#judul_tambah').html('Tambah Kamus');
            $('#hapus_kamus').prop('hidden', true);
            $('#id').val(0);
        });
        $('.edit_kamus').on('click', function() {
            clear_form_kamus();
            $('#id').val($(this).data('id'));
            $.ajax({
                url: method_url('Kamus', 'get_kamus'),
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
                url: method_url('Kamus', 'insertedit'),
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
                    $('#keyword').val('');
                    tampil_flash();
                }
            });
        });
        $('#ya_hapus').on('click', function() {
            const id = $('#id').val();
            $.ajax({
                url: method_url('Kamus', 'delete_kamus'),
                data: {
                    id: id,
                },
                method: 'post',
                dataType: 'html',
                success: function(data) {
                    $('.konten-kamus').html(data);
                    $('#keyword').val('');
                    tampil_flash();
                }
            });
        });
        $('#keyword').on('keyup', function() {
            search(1);
        });
        $('.linkP').on('click', function() {
            search($(this).data('page'));
        });
    })
</script>