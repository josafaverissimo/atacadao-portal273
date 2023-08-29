<?php
  use Src\Core\Helpers;
?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/components/navbar_clock/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<div class="d-flex justify-content-center my-1 mb-5">
  <nav class="navbar navbar-expand-lg shadow-lg width-90vw rounded d-flex justify-content-center px-3 bg-white">
    <div class="d-flex w-100 justify-content-between">
        <div>
          <a class="navbar-brand" href="<?= Helpers::baseUrl(); ?>">
            <img src="<?= Helpers::baseUrl("/assets/imgs/atacadao-logo.png"); ?>" alt="Logo do atacadão">
          </a>
        </div>

        <div class="align-self-center">
            <ul class="nav">
                <?php
                    $links = [
                        [
                            "name" => "Central de links",
                            "url" => Helpers::baseUrl("/link-center"),
                            "uri" => "/link-center"
                        ],
                        [
                            "name" => "Boas práticas",
                            "url" => Helpers::baseUrl("/best-practices"),
                            "uri" => "/best-practices"
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

                <a class="nav-link <?= $active; ?>" <?= $targetBlank; ?> href="<?= $link["url"]; ?>">
                    <?= mb_convert_case($link["name"], MB_CASE_TITLE); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </div>

        <div class="navbar-clock">
            <?= $this->getViewHtml("/components/clock"); ?>
        </div>
    </div>
  </nav>
</div>

<?php $this->setSection("footer"); ?>
    <script src="<?= Helpers::baseUrl("/assets/js/components/navbar_clock/scripts.js"); ?>"></script>
<?php $this->endSection("footer"); ?>
