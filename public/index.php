<?php

use App\modules\Goods;
use App\modules\Users;

include_once dirname(__DIR__) . '/vendor/autoload.php';
/* spl_autoload_register([new Autoloder(), 'loadClass']); */




$goods = new Goods();
$users = new Users();

var_dump($goods->getAll());
/* var_dump($goods->getOne(1));
var_dump($goods->getOne(2)); */
var_dump(($users->getObj()));

/* $users->login = 'Bob';
$users->password = '123asd';
$users->user_name = 'Bob'; */
/* var_dump($users->insert()); */
