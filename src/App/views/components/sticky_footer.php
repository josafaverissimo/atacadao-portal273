<?php use Src\Core\Helpers; ?>

<?php $this->setSection("head"); ?>
  <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/components/sticky_footer.css"); ?>">
<?php $this->endSection("head"); ?>

<div class="container-fluid sticky-footer shadow-lg bg-white">
    <p class="d-flex w-100 justify-content-between m-0 p-2">
        <span>&copy;Todos os direitos reservados</span>
        <span>Desenvolvido pela equipe do cpd da filial 273</span>
    </p>
</div>