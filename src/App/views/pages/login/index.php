<?php
    use Src\Utils\Helpers;

    /**
     * @var string $title
     */
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <title><?= $title; ?></title>

        <link rel="icon" type="image/x-icon" href="<?= Helpers::baseUrl(CONF_PAGE_DEFAULT_ICON); ?>">
        <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/bootstrap/css/bootstrap.min.css"); ?>">
        <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/login/styles.css"); ?>">
    </head>

    <body>
        <div class="toast align-items-center text-bg-danger border-0 position-fixed end-0 top-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <span style="font-size: 1.2rem">Usuário ou senha incorretos 😾👊</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>

        <main class="container-fluid container-lg">
            <div class="pt-5 my-5 px-5 text-center rounded-2 shadow-lg">
                <div>
                    <h1>Login</h1>

                    <form class="d-flex flex-column align-items-center mb-5">
                        <div class="px-1">
                            <label for="user" class="form-label">Usuário</label>
                            <input type="text" id="user" class="form-control">
                        </div>

                        <div class="my-2">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" id="password" class="form-control">
                        </div>

                        <button class="btn btn-outline-dark" type="submit">Login</button>
                    </form>
                </div>

                <?php
                    $image = "default";

                    if($this->session->has("requestedResource")) {
                        $lastUrlExploded = explode("/", $this->session->get("requestedResource"));
                        $lastUri = $lastUrlExploded[count($lastUrlExploded) - 1];
                        $pages = ["crudx", "reports"];
                        $image = in_array($lastUri, $pages) ? $lastUri : "default";
                    }
                ?>
                <img src="<?= Helpers::baseUrl("/assets/imgs/{$image}-page.png") ?>" class="img-fluid shadow mb-4" alt="page requested" loading="lazy">
            </div>
        </main>

        <footer>
            <script src="<?= Helpers::baseUrl("/assets/bootstrap/js/bootstrap.bundle.js"); ?>"></script>
            <script src="<?= Helpers::baseUrl("/assets/js/scripts.js") ?>"></script>
            <script src="<?= Helpers::baseUrl("/assets/js/login/scripts.js") ?>"></script>
        </footer>
    </body>
</html>