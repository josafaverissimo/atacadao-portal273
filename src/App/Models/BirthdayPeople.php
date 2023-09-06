<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\BirthdayPeople as BirthdayPeopleOrm;

class BirthdayPeople extends Model
{
    public function __construct()
    {
        parent::__construct("is_birthday_people", new BirthdayPeopleOrm());
    }
}