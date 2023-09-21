<?php
    use Src\Utils\Helpers;

    /**
     * @var string $title
     * @var array $linksByCategory
     */
?>

<?php $this->template("/base", [ "title" => $title]); ?>

<main class="container-fluid container-lg">
    <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="p-3 p-lg-5 pt-lg-3">
            <h1 class="display-5 mb-3">Central de links</h1>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <ul class="nav nav-tabs" id="links-tab" role="tablist">
                        <?php foreach($linksByCategory as $categoryName => $categoryData): ?>
                            <?php $active = !empty($categoryData["active"]) ? " active" : ""; ?>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link<?= $active ?>"
                                    id="<?= $categoryName ?>-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#<?= $categoryName ?>"
                                    type="button"
                                    role="tab"
                                    aria-controls="home"
                                    aria-selected="true"
                                >
                                    <?= $categoryName ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <div id="links-search-filter" class="d-flex" role="search">
                        <input
                            class="form-control me-2"
                            type="search"
                            placeholder="Digite o nome ou link"
                            aria-label="Pesquisar"
                        >
                        <button class="btn btn-outline-secondary" type="button">Limpar</button>
                    </div>
                </div>
            </div>
            <div id="links-tab-content" class="tab-content">
                <div id="links-empty-message" class="py-5" hidden>
                    <h1 class="fs-3 text-center">Link não encontrado</h1>
                </div>
                <?php foreach($linksByCategory as $categoryName => $categoryData): ?>
                    <?php $active = !empty($categoryData["active"]) ? " active show" : ""; ?>

                    <div class="tab-pane fade<?= $active; ?>" id="<?= $categoryName; ?>" role="tabpanel" aria-labelledby="<?= $categoryName; ?>-tab">
                            <div class="row mb-2 justify-content-center">
                                <?php for($row = 0; $row < count($categoryData["links"]); $row += 3): ?>
                                    <?php
                                        for($column = 0; $column < 3; $column++):
                                            $index = $row + $column;
                                            if(!isset($categoryData["links"][$index])) break;
                                            $link = $categoryData["links"][$index];
                                    ?>
                                        <div class="col-md-6 col-lg-4 col-xl-3 mb-md-2">
                                            <?php $targetBlank = empty($link["notTargetBlank"]) ? "target=\"_blank\"" : ""; ?>
                                            <a class="card text-decoration-none" href="<?= $link["resource"]; ?>" <?= $targetBlank ?>>
                                                <div class="card-body d-flex justify-content-center">
                                                    <div>
                                                        <span class="card-title"><?= mb_convert_case($link["name"], MB_CASE_TITLE); ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endfor; ?>
                                <?php endfor; ?>
                            </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if(empty($linksByCategory)): ?>
                <hr>
                <p>Não há links no banco de dados.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php $this->setSection("footer"); ?>
    <?php
        Helpers::setLocalStorage([
            ["linksByCategory", json_encode($linksByCategory)]
        ]);
    ?>
    <script src="<?= Helpers::baseUrl("/assets/js/link_center/scripts.js"); ?>"></script>
<?php $this->endSection("footer"); ?>
