<?php $this->template("/base", [ "title" => $title]); ?>

<?php
    $links = [
        [
            "name" => "Link1",
            "url" => "url"
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
        ],
    ];
?>

<main class="container py-5 bg-white">
    <div class="bg-white">
        <div class="cards-wrapper">
            <?php for($row = 0; $row < count($links); $row += 3): ?>    
                <div class="row mb-2">
                    <?php for($column = 0; $column < 3; $column++): ?>
                        <?php
                            $index = $row + $column;

                            if(!isset($links[$index])) break;
    
                            $link = $links[$index];
                        ?>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $link["name"]; ?></h5>
                                    <a class="btn btn-link" href="<?= $link["url"]; ?>">Link</a>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</main>
