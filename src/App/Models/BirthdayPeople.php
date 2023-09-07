<?php

namespace Src\App\Models;

use Src\Core\Database\Model;
use Src\App\Models\Orms\BirthdayPeople as BirthdayPeopleOrm;
use Src\Interfaces\Database\IModel;

class BirthdayPeople extends Model implements IModel
{
    public function __construct()
    {
        parent::__construct("is_birthday_people", new BirthdayPeopleOrm());
    }
}