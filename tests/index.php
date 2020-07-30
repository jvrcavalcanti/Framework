<?php

use Pendragon\Framework\App;
use Pendragon\Framework\Web\Session;

require_once '../vendor/autoload.php';

$app = new App();

$app->bind("user", Session::class);

dd($app->make('user'));
