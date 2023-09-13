<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\UserOrm;

class UsersModel extends Model
{
    public function __construct()
    {
        parent::__construct("is_users", new UserOrm());
    }
}