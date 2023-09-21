<?php
    use Src\Utils\Helpers;

    /**
     * @var string $title
     */
?>

<?php $this->template("base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/errors/404/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<main class="container-fluid container-lg">
    <div class="bg-white rounded-3 border shadow-lg">
        <div class="d-flex justify-content-center">
            <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/gokukid.gif"); ?>">
            <img class="strong-tilt-move-shake" alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/error404.png"); ?>">
            <img alt="mk" class="flip-image" src="<?= Helpers::baseUrl("/assets/imgs/gokukid.gif"); ?>">
        </div>
        <div class="d-flex justify-content-evenly">
            <div class="align-self-center">
                <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/kunglao-girando.gif"); ?>">
                <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/scorpion-fatality.gif"); ?>">
            </div>
            <img alt="mk" class="shake rounded-5 " src="<?= Helpers::baseUrl("/assets/imgs/shaokhanfinishhim.gif"); ?>">
            <div class="align-self-center">
                <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/liukang-dancando.gif"); ?>">
            </div>
        </div>
        <div class="p-3 p-lg-5 pt-lg-3 d-flex justify-content-evenly">
            <div>
                <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/liukang-correndo.gif"); ?>">
            </div>

            <div>
                <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/liu-kang-bicycle-kick.gif"); ?>">
            </div>
            <div>
                <img alt="mk" class="flip-image" src="<?= Helpers::baseUrl("/assets/imgs/shaokahn-parado.gif"); ?>">
            </div>
        </div>
    </div>
</main>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/wait-images.js"); ?>"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            waitImages()
        })
    </script>
<?php $this->endSection("footer"); ?>
