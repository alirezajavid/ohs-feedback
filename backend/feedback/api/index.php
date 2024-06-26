<?php
session_start();
include "config.php";
require_once "sendmail.php";
require_once "save_pdf.php";
header('Content-Type: application/json; charset=utf-8');
@mkdir('repository');
$action = @$_GET['action'];
$REQUEST_METHOD = @$_SERVER['REQUEST_METHOD'];

function check_auth()
{
    global $_SESSION;
    if (@$_SESSION['loggedin'] != true) {
        http_response_code(401);
        print(json_encode(['message' => 'Invalid authentication.']));
        exit();
    }
    return true;
}
if ($REQUEST_METHOD === 'GET' && $action == "categories_items") {
    $data = json_decode(file_get_contents("configs/categories.json"), true);
    foreach($data['categories'] as $k => $v)
    {
        unset($data['categories'][$k]['emails']);
    }
    print(json_encode($data, true));
    exit();
}
else
if ($REQUEST_METHOD === 'GET' && $action == "categories" && check_auth()) {
    readfile("configs/categories.json");
    exit();
}
else
if ($REQUEST_METHOD === 'PATCH' && $action == "categories" && check_auth()) {
    $data = json_decode(file_get_contents('php://input'));
    update_categories($data->category, $data->id, $data->name, $data->email);
    exit();
}
else
if ($REQUEST_METHOD === 'POST' && $action == "categories" && check_auth()) {
    $data = json_decode(file_get_contents('php://input'));
    add_email_to_categories($data->category, $data->name, $data->email);
    exit();
}
else
if ($REQUEST_METHOD === 'DELETE' && $action == "categories" &&  check_auth()) {
    delete_email_from_categories($_GET['category'], $_GET['id']);
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
if ($REQUEST_METHOD === 'GET' && $action == "logout") {
    unset($_SESSION['loggedin']);
    exit();
}
else
if ($REQUEST_METHOD === 'POST' && $action == "login") {
    $success = ($_POST['username'] == 'admin' && $_POST['password'] == 'helix!@#');
    $_SESSION['loggedin'] = true;
    http_response_code($success?200:401);
    print json_encode(["loggedin" => $success]);
    exit();
}
else {
    http_response_code(404);
    header('Content-Type: text/html; charset=utf-8');
    print "<html><body><h1 style='margin-top:120px'><center>No Page Gashangam</center></h1></body></html>";
}
