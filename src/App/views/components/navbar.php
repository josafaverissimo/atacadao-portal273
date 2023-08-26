<?php
  use Src\Core\Helpers;
?>

<div class="d-flex flex-column align-items-center bg-dark text-white">
  <div>
    <h1>Atacadão</h1>
  </div>
  
  <div>
    <h2>Maceió Petropólis</h2>
  </div>
</div>

<div class="d-flex justify-content-center my-1">
  <nav class="navbar navbar-expand-lg shadow-lg width-90vw rounded d-flex justify-content-center">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= Helpers::baseUrl(); ?>">
        <img class="ml-3" src="<?= Helpers::baseUrl("/assets/imgs/atacadao-logo.png"); ?>" alt="Logo do atacadão">
      </a>
     
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <?php
            $links = [
              [
                "name" => "Central de links",
                "url" => Helpers::baseUrl("/links-center")
              ],
              [
                "name" => "Relatórios",
                "url" => Helpers::baseUrl("/reports")
              ],
              [
                "name" => "Intranet Matriz",
                "url" => "http://portal.atacadao.com.br/"
              ]
            ]
          ?>

          <?php foreach($links as $link): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= $link["url"]; ?>"><?= $link["name"]; ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </nav>
</div>