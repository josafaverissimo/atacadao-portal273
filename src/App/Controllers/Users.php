<?php

namespace Src\App\Controllers;

use Src\App\Models\UsersModel;
use Src\Core\Controller;
use Src\Utils\Helpers;

class Users extends Controller
{
    private UsersModel $usersModel;

    public function __construct()
    {
        parent::__construct();

        $this->usersModel = new UsersModel();
    }

    public function create(): int
    {
        $post = Helpers::filterInputArray();

        return $this->usersModel->push([
            "username" => $post["username"],
            "password" => Helpers::passwordHash($post["password"])
        ]);
    }
}