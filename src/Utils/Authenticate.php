<?php

namespace Src\Utils;

use Src\App\Models\UsersModel;

class Authenticate
{
    private array $credentials;

    public function __construct()
    {
        $this->setCredentials();
    }

    private function setCredentials(): void
    {
        $credentials = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($credentials)) {
            return;
        }

        $this->credentials = $credentials;
    }

    public function getCredentials(): ?array
    {
        return $this->credentials ?? null;
    }

    public function isCredentialsValid(): bool
    {
        $usersModel = new UsersModel();

        $credentials = $this->getCredentials();

        if (empty($credentials)) {
            return false;
        }

        $sql = $usersModel->getSql();
        $success = $sql->select($usersModel->getTable())
            ->where("username =", $credentials["user"])
            ->execute();

        if (!$success) {
            return false;
        }

        $user = $sql->fetch();

        if ($user === false) {
            return false;
        }

        $userPasswordHash = $user->password;

        return password_verify($credentials["password"], $userPasswordHash);
    }
}
