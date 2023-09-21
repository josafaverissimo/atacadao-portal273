<?php
    use Src\Utils\Helpers;

    /**
     * @var string $title
     * @var array $tables
     */
?>

<?php $this->template("base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/crudx/styles.css"); ?>">
<?php $this->endSection("head"); ?>


<main>
    <div class="container-fluid container-lg">
        <div class="p-4 pb-0 p-lg-0 pt-lg-5 p-md-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
            <div class="row">
                <div class="col-8 p-3 p-lg-5 pt-lg-3">
                    <h1 class="display-3 fst-italic">CrudX</h1>
                    <p class="lead my-3">
                        Cadastre, Filtre, Atualize ou Delete.
                    </p>
                </div>

                <div class="col-4 px-lg-5 px-3 position-relative">
                    <div
                        class="bg-light border-start border-2 px-3 py-2 border-info
                            bg-info bg-opacity-10 shadow rounded-2 position-relative"
                        style="top: -2rem"
                    >
                        <span><em><strong>*Para Buscar*</strong></em></span>
                        <p class="text-indent">Apenas utilize o campo de filtro para buscar o que quer.</p>

                        <span><em><strong>*Para Adicionar ou Deletar*</strong></em></span>
                        <p class="text-indent">Clique com o botão direito sobre a linha deseja.</p>

                        <span><em><strong>*Para Atualizar*</strong></em></span>
                        <p class="text-indent">Salve um arquivo json no formato correto na pasta /dataset.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid container-lg" style="min-width: 90vw">
        <div class="row">
            <?php foreach($tables as $table): ?>
                <div class="col-lg-3 col-lg-4 pb-3 mb-3 update-table">
                    <div class="d-flex flex-column align-items-center pt-2">
                        <div class="card shadow" style="width: 100%">
                            <div class="card-header">
                                <h1 class="h5 m-0 text-center"><?= $table["name"] ?></h1>
                            </div>

                            <div class="p-2 d-flex flex-column align-items-center">
                                <div class="mb-1 table-actions">
                                    <button class="btn btn-outline-dark text-sm btn-sm create-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                        </svg>
                                    </button>
                                    <button class="btn btn-outline-dark text-sm update-button mx-2 btn-sm"
                                        data-target="<?= Helpers::baseUrl("/crudx/table/{$table["tableToUpdate"]}") ?>"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                        </svg>
                                    </button>
                                    <button class="btn btn-outline-dark text-sm btn-sm expand-button"
                                        data-table="<?= $table["tableToUpdate"] ?>-table"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-angle-expand" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707z"/>
                                        </svg>
                                    </button>
                                </div>
                                <div id="<?= $table["tableToUpdate"] ?>-search-filter" class="d-flex" role="search">
                                    <input class="form-control me-2 text-sm" type="search" placeholder="Digite algo para pesquisar" aria-label="Pesquisar">
                                    <button class="btn btn-outline-secondary text-sm" type="button">Limpar</button>
                                </div>
                            </div>

                            <?=
                                $this->getViewHtml("/components/my-table", [
                                    "id" => "{$table["tableToUpdate"]}-table",
                                    "classes" => "my-table",
                                    "thead" => $table["columns"],
                                    "rows" => $table["rows"],
                                    "attributes" => [
                                        "data-search-filter" => "#{$table["tableToUpdate"]}-search-filter",
                                        "data-table-to-update" => "{$table["tableToUpdate"]}"
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="modal-table-wrapper">
        <div class="modal fade"
            id="modal-expanded-table"
            aria-hidden="true"
            aria-labelledby="expanded-table"
            tabindex="-1"
        >
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Tabela</h1>
                        <button type="button" class="btn-close close"></button>
                    </div>
                    <div class="modal-body overflow-y-scroll">
                        <div id="create-form-wrapper" class="mb-3">
                            <div class="accordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#create-form-accordion"
                                        >
                                            Formulário de inserção
                                        </button>
                                    </h2>
                                    <div id="create-form-accordion" class="accordion-collapse collapse">
                                        <div class="accordion-body d-flex justify-content-center">
                                            <form class="d-flex flex-column align-items-center">
                                                <div class="d-flex align-items-center justify-content-center mb-2">
                                                    <div class="me-2">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="email">
                                                    </div>
                                                    <div>
                                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                </div>

                                                <div class="w-100">
                                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="main"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark close">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/crudx/scripts.js") ?>"></script>
<?php $this->endSection("footer"); ?>
