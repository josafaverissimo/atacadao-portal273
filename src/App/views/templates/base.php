<?php use Src\Core\Helpers; ?>

<?php $navbar =  $this->getViewHtml("/components/navbar"); ?>
<?php $stickyFooter = $this->getViewHtml("/components/sticky_footer"); ?>

<!doctype html>
<html lang="pt-br">
  <head>
      <link rel="icon" type="image/x-icon" href="<?= Helpers::baseUrl(CONF_PAGE_DEFAULT_ICON); ?>">
      <title><?= $title; ?></title>
  
      <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/bootstrap/css/bootstrap.min.css"); ?>">
      <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/styles.css"); ?>">
  
      <?= $this->getSection("head"); ?>
  </head>
  <body>
    <?= $navbar; ?>
    
    <?= $viewHtml; ?>
    
    <footer>
        <?= $stickyFooter; ?>
        <?= $this->getSection("footer"); ?>
        <script src="<?= Helpers::baseUrl("/assets/bootstrap/js/bootstrap.bundle.js"); ?>"></script>
    </footer>
  </body>
</html>