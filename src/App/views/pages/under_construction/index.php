<?php use Src\Core\Helpers; ?>

<?php $this->template("base", ["title" => $title]); ?>

<main class="container">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="fst-italic">Esta página está em construção</h1>
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
