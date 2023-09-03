<?php use Src\Core\Helpers; ?>

<?php $this->template("/base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/reports/styles.css") ?>">
<?php $this->endSection("head"); ?>

<main class="container-fluid container-lg pb-1">
    <div class="p-4 pb-0 p-lg-0 pt-lg-5 p-md-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="row justify-content-center pb-3">
            <div class="p-3 col-md-12 col-lg-6 p-lg-5 pt-lg-3 reports-lg-border-end">
                <h1 class="display-5 mb-3 text-center">Relatórios internos</h1>

                <div class="reports list-group shadow">
                    <?php foreach($internalReports as $report): ?>
                        <a href="<?= $report["url"] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h1 class="h5 mb-1"><?= ucfirst($report["name"]); ?></h1>
                                <small><?= $report["time"] ?? "" ?></small>
                            </div>
                            <p class="mb-1"><?= $report["description"]; ?></p>
                            <small class="fst-italic"><em>Relatório gerado pela equipe do cpd</em></small>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="p-3 col-md-12 col-lg-6 p-lg-5 pt-lg-3">
                <h1 class="display-5 mb-3 text-center">Relatórios do S.A.V.E</h1>

                <div class="reports list-group shadow">
                    <?php foreach($saveReports as $report): ?>
                        <a href="" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h1 class="h5 mb-1"><?= $report->name ?></h1>
                                <small>Há 3 dias</small>
                            </div>
                            <p class="mb-1"><?= ucfirst(mb_strtolower($report->description)); ?></p>
                            <small class="fst-italic"><em>Relatório gerado durante a rotina batch</em></small>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>