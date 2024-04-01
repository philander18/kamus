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
    <?= $this->renderSection('page-content'); ?>
    <script src="<?= base_url(); ?>public/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>public/js/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <?= $this->include('Kamus/script'); ?>
</body>

</html>