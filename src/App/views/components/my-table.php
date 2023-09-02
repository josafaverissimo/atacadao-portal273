<?php use Src\Core\Helpers; ?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/components/my_table/styles.css") ?>">
<?php $this->endSection("head"); ?>

<div id="<?= $id ?>" class="my-table <?= $classes ?> shadow">
    <div class="spinner spinner-border text-secondary" role="status" hidden>
        <span class="visually-hidden">Carregando...</span>
    </div>
    <table class="table table-striped table-bordered w-100">
        <?php if(!empty($thead)): ?>
            <thead>
                <tr>
                    <?php foreach($thead as $th): ?>
                        <th><?= $th ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
        <?php endif; ?>
        <tbody>
        <?php foreach($rows as $cells): ?>
            <tr>
                <?php foreach($cells as $cell): ?>
                    <td><?= $cell ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/components/my_table/scripts.js") ?>"></script>
<?php $this->endSection("footer"); ?>
