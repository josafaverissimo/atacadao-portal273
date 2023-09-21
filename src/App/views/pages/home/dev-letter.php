<?php
    use Src\Utils\Helpers;

    /**
     * @var string $title
     */
?>

<?php $this->template("base", ["title" => $title]); ?>

<main class="container-fluid container-lg">
    <div class="p-4 pb-0 p-lg-0 pt-lg-5 p-md-5 align-items-center rounded-3 border shadow-lg mb-3 bg-white">
        <div class="p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fst-italic">&lt;?= Carta do desenvolvedor ?&gt;</h1>
            <hr>
            <p class="lead my-3 px-5">
                <span class="d-block mb-3" style="font-size: .8rem">
                    From: josafá<br>
                    To: a quem interessar
                </span>

                <span class="d-block mb-3">
                    <span class="text-body-emphasis fw-bolder">Hello world!</span>
                    Me chamo Josafá, sou um desenvolvedor web especialista em <span class="">backend</span>
                    com foco em PHP e Javascript.
                </span>

                <span class="d-block mb-3">
                    Este sistema foi criado com o intuito de aprender mais sobre programação. Sempre procuro aprender cada
                    vez mais sobre programação, e dado ao grande acúmulo de conhecimento que adquiri ao longo do tempo,
                    decide colocá-lo em prática e compartilhá-lo.
                </span>

                <span class="d-block mb-3">
                    Este sistema não utiliza nenhum framework popular. Sua stack é: PHP, MariaDB, Javascript, Html5 e Css3.
                    O sistema segue a arquitetura MVC <em>(Model, View, Controller)</em> e a sua implementação neste
                    projeto foi feita por mim, do absoluto zero. O sistema de rotas, os controllers, models, os orms, e
                    o sistema de renderização de views.
                </span>

                <span class="d-block mb-3">
                    Criei meu framework para entender como os componentes de um grande framework funcionam em sua essência.
                    Nós, programadores, aprendemos fazendo! Estou muito feliz com o resultado, pois provei a mim que
                    o PHP moderno é capaz de criar sistemas escaláveis, com uma boa escrita e organização.
                </span>

                <span class="d-block mb-3">
                    Espero que tenha gostado desse portal ^^. Sinta-se livre para utilizar ou alterar todo o projeto e sua estrutura para atender a alguma de sua
                    necessidade, desenvolver um novo sistema, ou para simplesmente aprender.
                </span>

                <span class="d-block mb-3">
                    <span class="d-block mb-2">
                        Quer trocar alguma ideia? Está precisando de ajuda? Pode contar comigo!
                        Abaixo estão meu linkedin e email.
                    </span>

                    <img src="<?= Helpers::baseUrl("/assets/imgs/linkedin-icon.svg") ?>" alt="linkedin icon" width="22">
                    <a class="fw-bold mx-2"
                       style="font-size: .8em"
                       href="https://www.linkedin.com/in/josafaverissimo/"
                       target="_blank"
                    >
                        linkedin.com/in/josafaverissimo/
                    </a><br>

                    <img src="<?= Helpers::baseUrl("/assets/imgs/email-icon.svg") ?>" alt="linkedin icon" width="22">
                    <a class="fw-bold mx-2"
                       style="font-size: .8em"
                       href="mailto:josafaverissimo98@gmail.com"
                    >
                        josafaverissimo98@gmail.com
                    </a>
                </span>
            </p>
        </div>
    </div>
</main>
