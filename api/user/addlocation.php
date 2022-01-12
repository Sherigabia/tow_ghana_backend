<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/location.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($location->validate_params($_POST['userID'])) {
        $location->user_id = $_POST['userID'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'User ID is required!'));
        die();
    }

    if ($location->validate_params($_POST['longitude'])) {
        $location->longitude= $_POST['longitude'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Longitude is required!'));
        die();
    }
    
    if ($location->validate_params($_POST['latitude'])) {
        $location->latitude= $_POST['latitude'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Latitude is required!'));
        die();
    }
    if ($location->validate_params($_POST['address'])) {
        $location->address= $_POST['address'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Address is required!'));
        die();
    }


    if ($location->add_location()) {
        echo json_encode(array('success' => 1, 'message' => 'Location successfully added!'));
    } else {
        http_response_code(500);
        echo json_encode(array('success' => 0, 'message' => 'Internal Server Error!'));
    }
} else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
}