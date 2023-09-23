<?php
    use Src\Utils\Helpers;
?>

<?php $this->setSection("head"); ?>
    <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/components/navbar/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<div class="d-flex justify-content-center mt-2 position-relative">
  <nav class="navbar navbar-expand-lg shadow-lg width-90vw rounded d-flex justify-content-center px-3 position-fixed">
    <div class="d-flex w-100 justify-content-between">
        <div>
          <a class="btn btn-link navbar-brand p-0" href="<?= Helpers::baseUrl(); ?>">
            <img src="<?= Helpers::baseUrl("/assets/imgs/atacadao-logo.png"); ?>" alt="Logo do atacadão">
          </a>
        </div>

        <div class="align-self-center">
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
                        "name" => "Ramais",
                        "url" => Helpers::baseUrl("/phones"),
                        "uri" => "/phones"
                    ],
                ]
            ?>
            <ul class="nav d-sm-none d-lg-flex">
                <?php foreach($links as $link): ?>
                    <li class="nav-item">
                        <?php
                            $active = (isset($link["uri"]) && $link["uri"] === $_SERVER["REQUEST_URI"])
                            ? "border-bottom border-primary border-radius-none "
                            : "";

                            $targetBlank = !empty($link["blank"]) ? "target=\"_blank\"" : "";
                        ?>

                        <a class="nav-link <?= $active; ?>" <?= $targetBlank; ?> href="<?= $link["url"]; ?>">
                            <?= mb_convert_case($link["name"], MB_CASE_TITLE); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul class="nav d-sm-block d-lg-none">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Navegue por aqui
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach($links as $link): ?>
                            <li>
                                <a class="dropdown-item" href="<?= $link["url"]; ?>">
                                    <?= mb_convert_case($link["name"], MB_CASE_TITLE); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
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
