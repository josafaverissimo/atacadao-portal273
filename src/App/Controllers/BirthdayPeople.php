<?php

namespace Src\App\Controllers;

use Src\App\Models\BirthdayPeopleModel;

use Src\Core\Controller;
use Src\Utils\Helpers;

class BirthdayPeople extends Controller
{
    private BirthdayPeopleModel $birthdayPeopleModel;

    public function __construct()
    {
        parent::__construct();

        $this->birthdayPeopleModel = new BirthdayPeopleModel();
    }

    public function create(): int
    {
        $post = Helpers::filterInputArray();

        return $this->birthdayPeopleModel->push([
            "name" => $post["name"],
            "birthday" => Helpers::dateBrToSystemFormat($post["birthday"])
        ]);
    }
}