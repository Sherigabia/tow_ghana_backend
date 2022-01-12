<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user->validate_params($_POST['token'])) {
        $user->token = $_POST['token'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Token is required!'));
        die();
    }
    if ($user->validate_params($_POST['password'])) {
        $user->password = $_POST['password'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Password is required!'));
        die();
    }


    $s = $user->updatePassword();
    if($s){
        http_response_code(200);
        echo json_encode(array('success'=>1, 'message'=>'Password Updated'));
    }
    else{
        http_response_code(402);
        echo json_encode(array('success'=>0, 'message' => 'Error Updating Pasword'));
    }
    // if ($s) { 
    //     http_response_code(200);
    //     echo json_encode(array('success' => 1, 'message' => $s));
    // } else {
    //     http_response_code(402);
    //     echo json_encode(array('success' => 0, 'message' => $s));
    // }
}
 else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
}