<?php
    use Src\Utils\Helpers;
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

                <img src="<?= Helpers::baseUrl("/assets/imgs/system.png") ?>" class="img-fluid shadow mb-4" alt="Example image" loading="lazy">
            </div>
        </main>

        <footer>
            <script src="<?= Helpers::baseUrl("/assets/bootstrap/js/bootstrap.bundle.js"); ?>"></script>
            <script src="<?= Helpers::baseUrl("/assets/js/scripts.js") ?>"></script>
            <script src="<?= Helpers::baseUrl("/assets/js/login/scripts.js") ?>"></script>
        </footer>
    </body>
</html>