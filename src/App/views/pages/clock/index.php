<?php
    use Src\Utils\Helpers;

    /**
     * @var string $title
     */
?>

<?php $this->template("base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/clock/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<main class="container-fluid container-lg">
    <div class="clock rounded-3 border shadow-lg bg-white py-5">
        <?= $this->getViewHtml("/components/clock"); ?>
    </div>
</main>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/clock/scripts.js"); ?>"></script>
<?php $this->endSection("footer"); ?>
