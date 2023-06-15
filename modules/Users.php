<?php

namespace App\modules;

/**
 * Class Model
 * @property string $login
 */
class Users extends Model
{
    public $login;
    public $user_name;
    public $password;

    protected $selectName = 'users';
}
