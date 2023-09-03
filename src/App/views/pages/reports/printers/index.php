<?php use Src\Core\Helpers; ?>

<?php $this->template("/base", ["title" => $title]); ?>

<main class="container-fluid container-lg pb-1">
    <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="p-3 px-lg-5 pt-lg-3">
            <h1 class="display-5">Estatísticas das impressoras</h1>
        </div>

        <div class="row justify-content-center px-5">
            <?php foreach($printers as $printer): ?>
                <div class="col-lg-3 col-lg-4 pb-3 mb-3">
                    <div class="d-flex flex-column align-items-center border pb-3 pt-2 shadow">
                        <img src="<?= Helpers::baseUrl("/assets/imgs/{$printer->image}") ?>"
                             class="img-fluid"
                             alt="Imagem impressora <?= $printer->name ?>">
                        <div class="card shadow" style="width: 70%">
                            <div class="card-header">
                                <h1 class="h5 m-0 text-center"><?= ucfirst($printer->name) ?></h1>
                            </div>

                            <table class="table table-striped table-bordered m-0">
                                <tbody>
                                    <tr>
                                        <td>Toner</td>
                                        <td class="text-center align-middle"><?= $printersData[$printer->name]["toner"] ?? "N/A"?>%</td>
                                    </tr>
                                    <tr>
                                        <td>Impressões até agora</td>
                                        <td class="text-center align-middle"><?= $printersData[$printer->name]["totalPrintsToday"] ?? "N/A" ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total de impressões</td>
                                        <td class="text-center align-middle"><?= $printersData[$printer->name]["totalPrints"] ?? "N/A" ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>