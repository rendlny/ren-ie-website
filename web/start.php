<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Models\Database;
//Initialize Illuminate Database Connection
new Database();

if (!isset($_SESSION)) {
  session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/config.ini');
$web_data = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/website_data.ini', true);
