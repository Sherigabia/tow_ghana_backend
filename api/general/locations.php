<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/location.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($location->validate_params($_GET['userID'])) {
        $location->user_id = $_GET['userID'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'User ID is required!'));
        die(); 
    }

    echo json_encode(array('success' => 1, 'location' => $location->get_location_per_user()));
} else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
}