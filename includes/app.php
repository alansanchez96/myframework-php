<?php

require 'helpers.php';
require 'database.php';
require __DIR__ . '/../vendor/autoload.php';

\Model\Builder\ActiveRecord::setDB($db);
