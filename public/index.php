<?php
require "../bootstrap.php";
use Src\Controller\TimeController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// all of our endpoints start with /time
// everything else results in a 404 Not Found
if ($uri[1] !== 'time') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// the date must be a dateTime format:
$date = date_create_from_format('d/m/Y:H:i:s', $uri[2]);

$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and date to the TimeController and process the HTTP request:
$controller = new TimeController($requestMethod, $date);
$controller->processRequest();
