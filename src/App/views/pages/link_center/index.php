<?php use Src\Core\Helpers; ?>

<?php $this->template("/base", [ "title" => $title]); ?>

<?php
    $linksByCategory = [
        "general-links" => [
            [
                "name" => "Home",
                "url" => Helpers::baseUrl("/"),
                "targetBlank" => false
            ],
            [
                "name" => "Link2",
                "url" => "url"
            ],
            [
                "name" => "Link3",
                "url" => "url"
            ],
            [
                "name" => "Link4",
                "url" => "url"
            ],
            [
                "name" => "Link5",
                "url" => "url"
            ],
            [
                "name" => "Link6",
                "url" => "url"
            ],
            [
                "name" => "Link7",
                "url" => "url"
            ],
            [
                "name" => "Link8",
                "url" => "url"
            ],
            [
                "name" => "Link9",
                "url" => "url"
            ],
            [
                "name" => "Link10",
                "url" => "url"
            ]
        ],
        "management-links" => [],
        "register-links" => [],
        "cpd-links" => []
    ];
?>

<main class="container bg-white">
    <div class="bg-white p-4 pb-0 pe-lg-0 pt-lg-5">
        <div class="cards-wrapper p-3 p-lg-5 pt-lg-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <?php foreach(array_keys($linksByCategory) as $category): ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="general-tab" data-bs-toggle="tab" data-bs-target="#<?= $category; ?>" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <?= $category; ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Digite o nome do site ou link" aria-label="Pesquisar">
                        <button class="btn btn-outline-secondary" type="button">Limpar</button>
                    </form>
                </div>
            </div>
            <div class="tab-content">
                <?php foreach($linksByCategory as $category => $links): ?>
                    <div class="tab-pane fade active show" id="general-links" role="tabpanel" aria-labelledby="general-links-tab">
                        <?php for($row = 0; $row < count($links); $row += 3): ?>
                        <div class="row mb-2">
                            <?php for($column = 0; $column < 3; $column++): ?>
                                <?php
                                    $index = $row + $column;

                                    if(!isset($links[$index])) break;

                                    $link = $links[$index];
                                ?>
                                <div class="col-4">
                                    <div class="card" role="button">
                                        <div class="card-body d-flex justify-content-between">
                                            <div>
                                                <span class="card-title"><?= $link["name"]; ?></span>
                                            </div>
                                            <div>
                                                <a href="<?= $link["url"]; ?>" target="_blank">Link</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php endfor; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
