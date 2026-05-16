<?php
use StorageApi\StorageApi;
require 'vendor/autoload.php';

$config = require 'config.php';
$storage = new StorageApi($config);