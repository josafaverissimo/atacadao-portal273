<?php use Src\Core\Helpers; ?>

<?php $this->template("base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/clock/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<main class="container">
    <h1 class="text-center time">
        <?php
            $months = [
                "janeiro",
                "fevereiro",
                "março",
                "abril",
                "maio",
                "junho",
                "julho",
                "agosto",
                "setembro",
                "outubro",
                "novembro",
                "dezembro"
            ];

            $now = new DateTime("now");
            $time = $now->format("H:i:s");
            $date = $now->format("d") . " de ";
            $month = ((int) $now->format("m")) - 1;
            $date .= $months[$month];
            $date .= " " . $now->format("Y");
        ?>
        <time datetime="<?= $time; ?>">
            <?= $time; ?>
        </time>
    </h1>
    <?php

    ?>
    <h2 class="text-center date"><time datetime="2023-08-27"><?= $date; ?></time></h2>
</main>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/clock/scripts.js"); ?>"></script>
<?php $this->endSection("footer"); ?>
