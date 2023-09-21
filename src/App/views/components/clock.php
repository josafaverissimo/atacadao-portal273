<?php
    use Src\Utils\Helpers;
?>

<span class="time">
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
        $date .= " de " . $now->format("Y");
    ?>
    <time datetime="<?= $time; ?>">
        <?= $time; ?>
    </time>
</span>
<span class="date"><time datetime="<?= $now->format("Y-m-d"); ?>"><?= $date; ?></time></span>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/clock/clock.js"); ?>"></script>
<?php $this->endSection("footer"); ?>