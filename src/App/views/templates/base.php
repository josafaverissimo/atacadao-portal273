<?php

use Src\Core\Helpers;

?>

<!doctype html>
<html lang="pt-br">
<head>
    <link rel="icon" type="image/x-icon" href="<?= CONF_PAGE_DEFAULT_ICON ?>">
    <title><?= $title; ?></title>

    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/bootstrap/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/styles.css"); ?>">

    <?= $this->getSection("head"); ?>
</head>
<body>
<?= $viewHtml; ?>

<footer>
    <?= $this->getSection("footer"); ?>

    <script src="<?= Helpers::baseUrl("/assets/bootstrap/js/bootstrap.bundle.js"); ?>"></script>
</footer>
</body>
</html>