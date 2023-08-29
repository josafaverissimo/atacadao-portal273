<?php use Src\Core\Helpers; ?>

<?php $this->template("base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/errors/404/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<main class="container bg-white rounded-3 border shadow-lg">
    <div class="row pt-3">
        <div class="d-flex justify-content-center">
            <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/gokukid.gif"); ?>">
            <img class="strong-tilt-move-shake" alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/error404.png"); ?>">
            <img alt="mk" class="flip-image" src="<?= Helpers::baseUrl("/assets/imgs/gokukid.gif"); ?>">
        </div>
        <div class="d-flex justify-content-center">
            <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/shaokhanfinishhim.gif"); ?>">
        </div>
    </div>
    <div class="row">
        <div class="p-3 p-lg-5 pt-lg-3 d-flex justify-content-evenly">
            <div>
                <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/kunglao-girando.gif"); ?>">
                <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/scorpion-fatality.gif"); ?>">
            </div>

            <div>
                <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/liukang-correndo.gif"); ?>">
            </div>

            <div>
                <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/liu-kang-bicycle-kick.gif"); ?>">
            </div>
            <div>
                <img alt="mk" class="flip-image" src="<?= Helpers::baseUrl("/assets/imgs/shaokahn-parado.gif"); ?>">
            </div>

            <div>
                <img alt="mk" src="<?= Helpers::baseUrl("/assets/imgs/liukang-dancando.gif"); ?>">
            </div>
        </div>
    </div>
</main>
