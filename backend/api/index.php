<?php

include "config.php";
require_once "sendmail.php";
require_once "save_pdf.php";
header('Content-Type: application/json; charset=utf-8');
@mkdir('repository');
$action = @$_GET['action'];
$REQUEST_METHOD = @$_SERVER['REQUEST_METHOD'];

if ($REQUEST_METHOD === 'GET' && $action == "categories") {
    readfile("configs/categories.json");
    exit();
}
else
if ($REQUEST_METHOD === 'GET' && $action == "types") {
    readfile("configs/types.json");
    exit();
}
else
if ($REQUEST_METHOD === 'POST' && $action == "send") {
    send_feedback();
    exit();
}
else
if ($REQUEST_METHOD === 'POST' && $action == "login") {
    $success = ($_POST['username'] == 'admin' && $_POST['password'] == 'admin');
    http_response_code($success?200:401);
    print json_encode(["loggedin" => $success]);
    exit();
}
else {
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    print "<html><body><h1 style='margin-top:120px'><center>No Page Gashangam</center></h1></body></html>";
}
