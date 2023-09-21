<?php
    use Src\Utils\Helpers;

    /**
     * @var string $id
     * @var string $name
     * @var array $options
     */
?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/components/my_select/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<div id="<?= $id ?>" class="dropdown my-select <?= $classes ?? "" ?>">
    <select name="<?= $name; ?>">
        <?php foreach($options as $option): ?>
            <?php $buttonPlaceholder = $option->selected ? $option->textContent : $buttonPlaceholder ?>
            <option
                id="my-select-<?= $id ?>-option-<?= $option->id ?>"
                value="<?= $option->value ?>"
                <?= $option->selected ? "selected" : "" ?>
            >
                <?= $option->textContent ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button class="btn btn-light btn-outline-dark dropdown-toggle text-capitalize" data-bs-toggle="dropdown" type="button">
        <?= $buttonPlaceholder ?>
    </button>

    <div class="dropdown-menu">
        <ul class="list-group-flush px-2">
            <li class="list-group-item">
                <input type="text" class="form-control" placeholder="<?= $inputPlaceholder ?? "Pesquisar" ?>">
                <div class="dropdown-divider"></div>
            </li>

            <ul class="p-0"></ul>
        </ul>
    </div>
</div>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/components/my_select/scripts.js"); ?>"></script>
<?php $this->endSection("footer"); ?>
