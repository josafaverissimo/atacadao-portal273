<?php
    use Src\Utils\Helpers;

    /**
     * @var string $classes
     * @var array $rows
     */
?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/components/my_table/styles.css") ?>">
<?php $this->endSection("head"); ?>

<?php

    if(!empty($attributes)) {
        $attributesString = array_reduce(
            array_keys($attributes),
            fn($attributesString, $name) => $attributesString . " {$name}=\"{$attributes[$name]}\"",
            ""
        );
    }
?>

<div
    <?= !empty($id) ? "id=\"{$id}\"" : "" ?>
    class="my-table <?= $classes ?> shadow"
    <?= $attributesString ?? "" ?>
>
    <div class="spinner spinner-border text-secondary" role="status" hidden>
        <span class="visually-hidden">Carregando...</span>
    </div>
    <table class="table table-striped table-bordered w-100 m-0">
        <?php if(!empty($thead)): ?>
            <thead>
                <?php
                    if(!empty($push)) {
                        if(!empty($push['thead'])) {
                            echo $push['thead'];
                        }
                    }
                ?>
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
