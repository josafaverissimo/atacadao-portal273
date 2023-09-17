<?php
    use Src\Utils\Helpers;
?>

<?php $this->setSection("head"); ?>
  <link rel="stylesheet" href="<?= Helpers::baseUrl("/assets/css/components/sticky_footer/styles.css"); ?>">
<?php $this->endSection("head"); ?>

<div class="container-fluid sticky-footer shadow-lg bg-white position-fixed">
    <p class="d-flex w-100 justify-content-between m-0 p-2">
        <span>&copy;Todos os direitos reservados</span>
        <span>
            Desenvolvido pela equipe do cpd da filial 273 -
            <a href="<?= Helpers::baseUrl("/dev-letter") ?>" class="fst-italic text-body-emphasis">
                Josafá Veríssimo Gomes
            </a>
        </span>
    </p>
</div>