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

    private function setCredentials(): bool
    {
        $headers = getallheaders();
        $authorization = $headers["Authorization"] ?? null;

        if (empty($authorization)) {
            return false;
        }

        $this->credentials = explode(
            ":",
            base64_decode(
                str_replace(
                    "Basic ",
                    "",
                    $authorization
                )
            )
        );

        return true;
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

        [$user, $password] = $credentials;

        $sql = $usersModel->getSql();
        $success = $sql->select($usersModel->getTable())
            ->where("username =", $user)
            ->execute();

        if (!$success) {
            return false;
        }

        $user = $sql->fetch();

        if ($user === false) {
            return false;
        }

        $userPasswordHash = $user->password;

        return password_verify($password, $userPasswordHash);
    }
}
