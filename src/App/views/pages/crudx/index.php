<?php
    use Src\Utils\Helpers;

    /**
     * @var string $title
     * @var array $tables
     */
?>

<?php $this->template("base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/components/my_select/styles.css") ?>">
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/crudx/styles.css") ?>">
<?php $this->endSection("head"); ?>


<main>
    <div class="container-fluid container-lg">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-8 col-md-12" style="height: 100%">
                <div class="px-3 p-4 pb-0 p-lg-0 pt-lg-5 p-md-5 align-items-center rounded-3 border shadow-lg bg-white">
                    <div class="p-3 p-lg-5 pt-lg-3">
                        <h1 class="display-3 fst-italic">CrudX</h1>
                        <p class="lead my-3">
                            Cadastre, Filtre, Atualize ou Delete quaisquer dados das tabela do banco de dados.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 px-lg-5 px-3 my-3">
                <div class="border-start border-2 px-3 py-2 border-info shadow rounded-2 bg-white">
                    <span><em><strong>Para adicionar</strong></em></span>
                    <p class="text-indent">Clique sobre o botão de adicionar ou maximize a tabela.</p>

                    <span><em><strong>Para buscar</strong></em></span>
                    <p class="text-indent">Apenas utilize o campo de filtro para buscar o que quer.</p>

                    <span><em><strong>Para atualizar ou deletar</strong></em></span>
                    <p class="text-indent">Clique com o botão direito sobre a linha deseja.</p>

                    <span><em><strong>Para recarregar</strong></em></span>
                    <p class="text-indent">Leia a documentação do projeto para entender como recarregar as tabelas.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid container-lg" style="min-width: 90vw">
        <div class="row">
            <?php foreach($tables as $table): ?>
                <div class="col-lg-3 col-lg-4 pb-3 mb-3 update-table">
                    <div class="d-flex flex-column align-items-center pt-2">
                        <div id="table-card-<?= $table["tableToUpdate"] ?>" class="card shadow" style="width: 100%">
                            <div class="card-header">
                                <h1 class="h5 m-0 text-center"><?= $table["name"] ?></h1>
                            </div>

                            <div class="p-2 d-flex flex-column align-items-center">
                                <div class="mb-1 table-actions" data-table-to-update="<?= $table["tableToUpdate"] ?>">
                                    <button class="btn btn-outline-dark text-sm btn-sm mx-2 reload-button">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-arrow-clockwise"
                                            viewBox="0 0 16 16"
                                        >
                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                        </svg>
                                    </button>
                                    <button class="btn btn-outline-dark text-sm btn-sm expand-button">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            width="16"
                                            height="16"
                                            fill="currentColor"
                                            class="bi bi-arrows-angle-expand"
                                            viewBox="0 0 16 16"
                                        >
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
                        <div class="mb-3">
                            <div class="accordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#create-form-wrapper"
                                        >
                                            Formulário de inserção
                                        </button>
                                    </h2>
                                    <div id="create-form-wrapper" class="accordion-collapse collapse">
                                        <div class="accordion-body d-flex justify-content-center">
                                            <form class="d-flex flex-column align-items-center">
                                                <div id="inputs-wrapper" class="d-flex align-items-end mb-3"></div>

                                                <div style="width: 6em">
                                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="table-expanded-search-filter" class="d-flex mt-3 mb-2" role="search">
                            <input class="form-control me-2 text-sm" type="search" placeholder="Digite algo para pesquisar" aria-label="Pesquisar">
                            <button class="btn btn-outline-secondary text-sm" type="button">Limpar</button>
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
    <script src="<?=  Helpers::baseUrl("/assets/js/components/my_select/scripts.js") ?>"></script>
    <script src="<?= Helpers::baseUrl("/assets/js/crudx/scripts.js") ?>"></script>
<?php $this->endSection("footer"); ?>
