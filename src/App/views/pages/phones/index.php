<?php use Src\Core\Helpers; ?>

<?php $this->template("base", ["title" => $title]); ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/phones/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<main class="container-fluid container-lg">
    <div class="p-4 pb-0 p-lg-0 pt-lg-5 p-md-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="p-3 p-lg-5 pt-lg-3">
            <h1 class="display-5 fst-italic mb-3">Lista de Ramais</h1>
            <div id="my-select" class="dropdown mb-2 my-select">
                <select name="unit">
                    <?php foreach($units as $unit): ?>
                        <option id="my-select-option-<?= $unit->id_filial; ?>" value="<?= $unit->id_filial; ?>">
                            <?= str_replace("-", " ", $unit->descricao); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" type="button">
                    Selecione uma filial
                </button>

                <div class="dropdown-menu">
                <ul class="list-group-flush px-2">
                    <li class="list-group-item">
                        <input type="text" class="form-control" placeholder="Filial">
                        <div class="dropdown-divider"></div>
                    </li>

                    <ul class="p-0"></ul>
                </ul>
                </div>
            </div>

            <table class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Setor</th>
                        <th>Responsável</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>11111111111</td>
                        <td>12313122133</td>
                        <td>12312312323</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/phones/scripts.js"); ?>"></script>
<?php $this->endSection("footer"); ?>
