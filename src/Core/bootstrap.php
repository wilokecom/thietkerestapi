<?php

use Dotenv\Dotenv;
use WilokeRestAPI\Users\Controllers\UserController;

require_once "vendor/autoload.php";
global $wpdb;

$dotenv = new DotEnv(dirname(dirname(__DIR__)));
$dotenv->load();

$oDBConnector = \WilokeRestAPI\Database\DBConnector::connect();
/**
 * @var \mysqli $wpdb
 */
$wpdb = $oDBConnector->oDB;

## Person Gateway ##
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$route = isset($_REQUEST['route']) ? $_REQUEST['route'] : null;
$aParseRoute = explode('/', $route);

$userId = isset($aParseRoute[1]) ? (int)$aParseRoute[1] : 0;
(new UserController($_SERVER['REQUEST_METHOD'], $userId))->userGateway();
