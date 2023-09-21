<?php
    use Src\Utils\Helpers;
    use Src\Interfaces\Database\IOrm;
    use Src\App\Models\Orms\BirthdayPersonOrm;

    /**
     * @var string $title
     * @var IOrm[] $birthdayPeople
     * @var IOrm[] $unitPhones
     */
?>

<?php $this->template("base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/home/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<main class="container-fluid container-lg">
    <div class="p-4 pb-0 p-lg-0 pt-lg-5 p-md-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fst-italic">Portal Interno<br>Maceió Petrópolis</h1>
            <p class="lead my-3">
                Aqui se encontra o que você precisa para navegar entre os sistemas e documentos da empresa.
            </p>

            <p class="lead mb-0">
                <a href="<?= Helpers::baseUrl("/link-center"); ?>" class="text-body-emphasis fw-bold fst-italic">
                    <em>Veja a central de links</em>
                </a>
            </p>
        </div>
    </div>

    <div class="row align-items-md-stretch wrapper">
        <div class="col-md-12 col-lg-6 p-lg-3 mb-md-3">
            <div class="h-100 p-5 shadow-sm target">
                <h2 class="text-center">Aniversariantes do mês</h2>

                <div id="birthday-people-search-filter" class="d-flex mb-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Digite o nome ou a data" aria-label="Pesquisar">
                    <button class="btn btn-outline-secondary" type="button">Limpar</button>
                </div>

                <?=
                    $this->getViewHtml("/components/my-table", [
                        "id" => "birthday-people",
                        "thead" => ["Nome", "Data"],
                        "classes" => "",
                        "rows" => array_map(
                            fn(BirthdayPersonOrm $orm) =>
                                $orm->formatBirthday()->getRowExcept("id"),
                            $birthdayPeople
                        ),
                        "attributes" => [
                            "data-search-filter" => "#birthday-people-search-filter"
                        ]
                    ])
                ?>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 align-self-start">
            <div class="h-100 p-5 shadow-sm target d-flex flex-column">
                <a href="<?= Helpers::baseUrl("/phones"); ?>" class="h2 align-self-center fst-italic">
                    <em>Lista de ramais</em>
                </a>

                <div id="phones-search-filter" class="d-flex mb-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Digite o número ou setor" aria-label="Pesquisar">
                    <button class="btn btn-outline-secondary" type="button">Limpar</button>
                </div>

                <?=
                    $this->getViewHtml("/components/my-table", [
                        "id" => "unit-phones",
                        "push" => [
                            "thead" => <<<HTML
                                <tr>
                                    <th colspan='2' class='text-center' style='background-color: #e0e0e0'">
                                        Filial 273
                                    </th>
                                </tr>
                             HTML
                        ],
                        "thead" => ["Número", "Setor"],
                        "classes" => "",
                        "rows" => array_map(fn(IOrm $orm) => $orm->getRow("number", "sector"), $unitPhones),
                        "attributes" => [
                            "data-search-filter" => "#phones-search-filter"
                        ]
                    ]);
                ?>
            </div>
        </div>
    </div>
</main>

<?php $this->setSection("footer"); ?>
    <?php
        Helpers::setLocalStorage([
            ["unitPhones", json_encode(array_map(fn(IOrm $orm) => $orm->getRow(), $unitPhones))]
        ]);
    ?>
    <script src="<?= Helpers::baseUrl("/assets/js/home/scripts.js"); ?>"></script>
<?php $this->endSection("footer"); ?>
