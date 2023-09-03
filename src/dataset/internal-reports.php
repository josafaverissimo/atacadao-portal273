<?php

use Src\Core\Helpers;

return [
    [
        "name" => "Estatísticas das impressoras",
        "description" => "Consulte a quantidade de impressões e acompanhe o nível do toner",
        "url" => Helpers::baseUrl("/reports/printers"),
        "time" => "agora"
    ]
];
