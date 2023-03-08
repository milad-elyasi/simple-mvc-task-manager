<?php
require 'app/bootstrap.php';
use App\App\Router;
use App\App\Request;

Router::load('routes/routes.php')
    ->direct(Request::uri(), Request::method());
