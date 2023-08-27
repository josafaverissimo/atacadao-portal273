<?php
  use Src\Core\Helpers;
?>

<div class="d-flex justify-content-center my-1 mb-5">
  <nav class="navbar navbar-expand-lg shadow-lg width-90vw rounded d-flex justify-content-center px-3">
    <div class="d-flex w-100 justify-content-between">
        <div>
          <a class="navbar-brand" href="<?= Helpers::baseUrl(); ?>">
            <img src="<?= Helpers::baseUrl("/assets/imgs/atacadao-logo.png"); ?>" alt="Logo do atacadão">
          </a>
        </div>
         
        <div class="align-self-center">          
            <ul class="nav nav-pills">
                <?php
                    $links = [
                        [
                            "name" => "Central de links",
                            "url" => Helpers::baseUrl("/links-center"),
                            "uri" => "/links-center"
                        ],
                        [
                            "name" => "Relatórios",
                            "url" => Helpers::baseUrl("/reports"),
                            "uri" => "/reports"
                        ],
                        [
                                "name" => "Relógio",
                                "url" => Helpers::baseUrl("/clock"),
                                "uri" => "/clock"
                        ],
                        [
                            "name" => "Intranet Matriz",
                            "url" => "http://portal.atacadao.com.br/",
                            "blank" => true
                        ],
                    ]
                ?>
            
            <?php foreach($links as $link): ?>
            <li class="nav-item">
                <?php $active = (isset($link["uri"]) && $link["uri"] === $_SERVER["REQUEST_URI"])
                    ? "border-bottom border-primary border-radius-none "
                    : "";
                ?>
                <?php $targetBlank = !empty($link["blank"]) ? "target=\"_blank\"" : ""?>
                    
                <a class="nav-link <?= $active; ?>" <?= $targetBlank; ?> href="<?= $link["url"]; ?>"><?= $link["name"]; ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
        </div>
    </div>
  </nav>
</div>