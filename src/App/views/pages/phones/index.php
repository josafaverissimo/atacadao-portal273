<?php
    use Src\Utils\Helpers;

    /**
     * @var string $title
     * @var array $unitsOptions
     * @var array $unitPhonesRows
     */
?>

<?php $this->template("base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/phones/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<main class="container-fluid container-lg">
    <div class="p-4 pb-0 p-lg-0 pt-lg-5 p-md-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="p-3 p-lg-5 pt-lg-3">
            <h1 class="display-5 mb-3">Lista de Ramais</h1>

            <div class="d-flex justify-content-between mb-2">
                <?=
                    $this->getViewHtml("/components/my-select", [
                        "options" => $unitsOptions,
                        "buttonPlaceholder" => "Selecione a filial",
                        "inputPlaceholder" => "Pesquise a filial",
                        "id" => "select-unit",
                        "name" => "unit"
                    ]);
                ?>
                <div>
                    <div id="phones-search-filter" class="d-flex" role="search">
                        <input class="form-control me-2 text-sm" type="search" placeholder="Digite algo para pesquisar" aria-label="Pesquisar">
                        <button class="btn btn-outline-secondary text-sm" type="button">Limpar</button>
                    </div>
                </div>
            </div>

            <?=
                $this->getViewHtml("/components/my-table", [
                    "id" => "unit-phones",
                    "classes" => "",
                    "thead" => ["Número", "Setor", "Responsável"],
                    "rows" => $unitPhonesRows,
                    "attributes" => [
                        "data-search-filter" => "#phones-search-filter"
                    ]
                ]);
            ?>

        </div>
    </div>
</main>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/phones/scripts.js"); ?>"></script>
<?php $this->endSection("footer"); ?>
