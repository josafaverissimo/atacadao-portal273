<?php use Src\Core\Helpers; ?>

<?php $this->template("base", ["title" => $title]); ?>

<main class="container-fluid container-lg">
    <div class="p-4 pb-0 p-lg-0 pt-lg-5 p-md-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="col-12 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-3 fst-italic">Atualize os dados</h1>
            <p class="lead my-3">
                Escolha, filtre e atualize ou carregue as informações.
            </p>
        </div>
    </div>

    <?php foreach($tables as $table): ?>
        <div class="col-lg-3 col-lg-4 pb-3 mb-3">
            <div class="d-flex flex-column align-items-center pt-2">
                <div class="card shadow" style="width: 100%">
                    <div class="card-header">
                        <h1 class="h5 m-0 text-center"><?= $table["name"] ?></h1>
                    </div>

                    <div class="p-2 d-flex flex-column align-items-center">
                        <div id="update-data-actions" class="mb-1">
                            <button id="load-button" class="btn btn-outline-dark text-sm" type="button">Carregar</button>
                            <button class="btn btn-outline-secondary text-sm mx-2" type="button">Ampliar</button>
                        </div>
                        <div id="update-data-search-filter" class="d-flex" role="search">
                            <input class="form-control me-2 text-sm" type="search" placeholder="Digite algo para pesquisar" aria-label="Pesquisar">
                            <button class="btn btn-outline-secondary text-sm" type="button">Limpar</button>
                        </div>
                    </div>

                    <?=
                        $this->getViewHtml("/components/my-table", [
                            "id" => "update-data-table",
                            "classes" => "",
                            "thead" => $table["columns"],
                            "rows" => $table["rows"]
                        ]);
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/update/scripts.js") ?>"></script>
<?php $this->endSection("footer"); ?>
