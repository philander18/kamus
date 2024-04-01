<script>
    $(document).ready(function() {
        $('#submit_tambah').on('click', function() {
            const materi = $('#materi').val(),
                topik = $('#topik').val(),
                isi = $('#isi').val();
            console.log(materi + topik + isi);
        });
    })
</script>