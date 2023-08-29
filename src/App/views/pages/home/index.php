<?php use Src\Core\Helpers; ?>

<?php $this->template("base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/home/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<main class="container">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-3 fst-italic">Portal Interno<br>Maceió Petrópolis</h1>
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
        <div class="col-md-6">
            <div class="h-100 p-5 shadow-sm target">
                <h2 class="text-center">Aniversariantes do mês</h2>

                <div class="scrollable-table-wrapper">
                    <table class="table table-striped table-bordered">
                        <tbody>
                        <?php foreach ($birthdayPeople as $birthdayPerson): ?>
                            <tr>
                                <td><?= $birthdayPerson->nome; ?></td>
                                <td><?= $birthdayPerson->aniversario; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 align-self-start">
            <div class="h-100 p-5 shadow-sm target">
                <h2 class="text-center">Lista de ramais</h2>

                <form id="phones-search-form" class="d-flex mb-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Digite o número ou setor" aria-label="Pesquisar">
                    <button class="btn btn-outline-secondary" type="button">Limpar</button>
                </form>

                <div class="scrollable-table-wrapper">
                    <table id="phones-table" class="table table-striped table-bordered">
                        <tbody>
                            <?php foreach($phonesUnit as $phone): ?>
                                <tr>
                                    <?php
                                        $phone->telefone = preg_replace("/(\(..\))(.+)/", "$1 $2", $phone->telefone);
                                        $phone->depto = mb_convert_case($phone->depto, MB_CASE_TITLE)
                                    ?>
                                    <td><?= $phone->telefone ?></td>
                                    <td><?= $phone->depto; ?></td>
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
    <script src="<?= Helpers::baseUrl("/assets/js/home/scripts.js"); ?>"></script>
    <script> PhoneTable.phones = <?= json_encode($phones);?></script>
<?php $this->endSection("footer"); ?>