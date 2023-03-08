<?php

use App\App\App;
use App\App\Database\QueryBuilder;
use App\App\Database\Connection;

require 'vendor/autoload.php';
require 'helpers/functions.php';

App::bind('config', require 'config.php');
App::bind('DB', new QueryBuilder(Connection::make(App::get('config')['DB'])));