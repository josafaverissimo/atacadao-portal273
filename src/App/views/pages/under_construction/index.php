<?php
    use Src\Utils\Helpers;

    /**
     * @var string $title
     */
?>

<?php $this->template("base", ["title" => $title]); ?>

<main class="container-fluid container-lg">
    <div class="p-4 pb-0 p-lg-0 pt-lg-5 p-md-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-3 fst-italic">Esta página está<br>em construção</h1>
            <p class="lead my-3">
                Estamos empenhados ao máximo para te entregar a melhor experiência.
            </p>

            <p class="lead mb-0">
                <a href="<?= Helpers::baseUrl("/link-center"); ?>" class="text-body-emphasis fw-bold">
                    Veja a central de links
                </a>
            </p>
        </div>
    </div>
</main>
