<?php

namespace Src\App\Models;

use Src\Core\Database\Model;

class BirthdayPeople extends Model
{
    public function __construct()
    {
        $table = "birthday_people";

        parent::__construct("birthday_people");
    }
}