<?php use Src\Core\Helpers; ?>

<?php $this->template("/base", [ "title" => $title]); ?>

<main class="container-fluid container-lg">
    <div class="p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="p-3 p-lg-5 pt-lg-3">
            <h1 class="display-5 fst-italic mb-3">Central de links</h1>
            <div class="cards-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <ul class="nav nav-tabs" id="links-tab" role="tablist">
                        <?php foreach($linksByCategory as $categoryId => $category): ?>
                            <?php $active = !empty($category["active"]) ? " active" : ""; ?>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link<?=$active; ?>"
                                    id="<?= $categoryId; ?>-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#<?= $categoryId; ?>"
                                    type="button"
                                    role="tab"
                                    aria-controls="home"
                                    aria-selected="true"
                                >
                                    <?= $category["description"]; ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <form id="links-filter-form" class="d-flex" role="search">
                        <input
                            class="form-control me-2"
                            type="search"
                            placeholder="Digite o nome ou link"
                            aria-label="Pesquisar"
                        >
                        <button class="btn btn-outline-secondary" type="button">Limpar</button>
                    </form>
                </div>
            </div>
            <div id="links-tab-content" class="tab-content">
                <div id="links-empty-message" class="py-5" hidden>
                    <h1 class="fs-3 text-center">Link não encontrado</h1>
                </div>
                <?php foreach($linksByCategory as $categoryId => $category): ?>
                    <?php $active = !empty($category["active"]) ? " active show" : ""; ?>
    
                    <div class="tab-pane fade<?= $active; ?>" id="<?= $categoryId; ?>" role="tabpanel" aria-labelledby="<?= $categoryId; ?>-tab">
                            <div class="row mb-2 justify-content-center">
                                <?php for($row = 0; $row < count($category["links"]); $row += 3): ?>
                                    <?php
                                        for($column = 0; $column < 3; $column++):
                                            $index = $row + $column;
                                            if(!isset($category["links"][$index])) break;
                                            $link = $category["links"][$index];
                                    ?>
                                        <div class="col-md-6 col-lg-4 mb-md-2">
                                            <?php $targetBlank = empty($link["notTargetBlank"]) ? "target=\"_blank\"" : ""; ?>
                                            <a class="card text-decoration-none" href="<?= $link["url"]; ?>" <?= $targetBlank; ?>>
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
        </div>
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
