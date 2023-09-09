<?php

use Src\Utils\Helpers;

return [
    "general-links" => [
        "description" => "Geral",
        "active" => true,
        "links" => [
            [
                "name" => "Home",
                "url" => Helpers::baseUrl("/"),
                "notTargetBlank" => true,
            ],
            [
                "name" => "Relógio",
                "url" => Helpers::baseUrl("/clock"),
                "notTargetBlank" => true
            ],
            [
              "name" => "Boas práticas",
              "url" => Helpers::baseUrl("/best-practices")
            ],
            [
                "name" => "Hodie Booking",
                "url" => "https://atacadao.hodiebooking.com.br/"
            ],
            [
                "name" => "Sistema de relatórios",
                "url" => Helpers::baseUrl("/reports"),
                "notTargetBlank" => true
            ],
            [
                "name" => "Controle da câmara fria",
                "url" => "https://srvsave273/projetofrios/"
            ],
            [
                "name" => "Lotus Notes",
                "url" => "http://srvnotes.atacadao.com.br/portal/PWN.nsf/Principal?openform"
            ],
            [
                "name" => "Lista de ramais",
                "url" => Helpers::baseUrl("/phones"),
                "notTargetBlank" => true
            ]
        ]
    ],
    "management-links" => [
        "description" => "Gerência",
        "links" => [
            [
                "name" => "Rub/Vue",
                "url" => "http://10.111.114.1/vue"
            ],
            [
                "name" => "Sistema IDM",
                "url" => "https://idm.atacadao.com.br:9443/itim/ui/Login.jsp"
            ]
        ]
    ],
    "register-links" => [
        "description" => "Cadastro",
        "links" => [
            [
                "name" => "Tplinux",
                "url" => "https://srvtpl273.br-atacadao.corp:8080/"
            ],
            [
                "name" => "Recargas",
                "url" => "https://srvsave273/recargas/"
            ],
            [
                "name" => "Sacolas",
                "url" => "https://srvsave273/sacolas/"
            ],
            [
                "name" => "Save Web",
                "url" => "https://srvapp273.br-atacadao.corp/"
            ],
            [
                "name" => "SitefWEB",
                "url" => "https://sitef.portal.br-atacadao.corp:1099/"
            ],
            [
                "name" => "Easy Promoter",
                "url" => "https://srvterceiros.br-atacadao.corp/"
            ]
        ]
    ],
    "cpd-links" => [
        "description" => "Cpd",
        "links" => [
            [
                "name" => "Tplinux",
                "url" => "https://srvtpl273.br-atacadao.corp:8080"
            ],
            [
                "name" => "Recargas",
                "url" => "https://srvsave273/recargas/"
            ],
            [
                "name" => "Rub/Vue",
                "url" => "http://10.111.114.1/vue"
            ],
            [
                "name" => "Sistema IDM",
                "url" => "https://idm.atacadao.com.br:9443/itim/ui/Login.jsp"
            ],
            [
                "name" => "CSC Cliente",
                "url" => "https://csc.br-atacadao.corp/otrs/customer.pl"
            ],
            [
                "name" => "CSC Agente",
                "url" => "https://csc.br-atacadao.corp/otrs/index.pl"
            ],
            [
                "name" => "Triangulus NFCE",
                "url" => "https://nfce.portal.br-atacadao.corp/NFCe_GDeWeb/saidas.aspx"
            ],
            [
                "name" => "Triangulus NFE AD",
                "url" => "https://nfe.portal.br-atacadao.corp/NFe_GDeWeb_AD/"
            ],
            [
                "name" => "Toshiba",
                "url" => "http://manager.selbetti.com.br/canal_cliente/"
            ],
            [
                "name" => "Tecnoset",
                "url" => "https://grupotecnoset.custhelp.com/"
            ],
            [
                "name" => "Monitoramento de links",
                "url" => "https://sw.portal.cloud.br-atacadao.corp/Orion/Login.aspx?sessionTimeout=yes"
            ],
            [
                "name" => "Wsus",
                "url" => "http://srvappsup.cloud.br-atacadao.corp/portal/pg-win/index.php"
            ],
            [
                "name" => "Zebra",
                "url" => "https://supportcommunity.zebra.com/"
            ]
        ]
    ] 
];