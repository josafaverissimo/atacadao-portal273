<?php
use Src\Utils\Helpers; ?>

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
                <a href="<?= Helpers::baseUrl("/link-center"); ?>" class="text-body-emphasis fw-bold">
                    Veja a central de links
                </a>
            </p>
        </div>
    </div>

    <div class="row align-items-md-stretch wrapper">
        <div class="col-md-12 col-lg-6 p-lg-3 mb-md-3">
            <div class="h-100 p-5 shadow-sm target">
                <h2 class="text-center">Aniversariantes do mês</h2>

                <div class="scrollable-table-wrapper">
                    <table class="table table-striped table-bordered">
                        <tbody>
                        <?php foreach ($birthdayPeople as $birthdayPerson): ?>
                            <tr>
                                <td><?= mb_convert_case($birthdayPerson->name, MB_CASE_TITLE); ?></td>
                                <td><?= Helpers::dateBr($birthdayPerson->birthday); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 align-self-start">
            <div class="h-100 p-5 shadow-sm target d-flex flex-column">
                <a href="<?= Helpers::baseUrl("/phones"); ?>" class="h2 align-self-center">
                    Lista de ramais
                </a>

                <div id="phones-search-filter" class="d-flex mb-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Digite o número ou setor" aria-label="Pesquisar">
                    <button class="btn btn-outline-secondary" type="button">Limpar</button>
                </div>

                <div class="scrollable-table-wrapper">
                    <table id="phones-table" class="table table-striped table-bordered">
                        <tbody>
                            <?php foreach($unitPhones as $phone): ?>
                                <tr>
                                    <td><?= preg_replace("/(\(\d\d\))/", "$1 ", $phone->phone) ?></td>
                                    <td><?= mb_convert_case($phone->owner, MB_CASE_TITLE) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->setSection("footer"); ?>
    <?php
        Helpers::setLocalStorage([
            ["unitPhones", json_encode($unitPhones)]
        ]);
    ?>
    <script src="<?= Helpers::baseUrl("/assets/js/home/scripts.js"); ?>"></script>
<?php $this->endSection("footer"); ?>
