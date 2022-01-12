<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Origin, Content-type, Accept'); // Handle pre-flight request

include_once '../../models/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user->validate_params($_POST['firstname'])) {
        $user->firstname = $_POST['firstname'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'FirstName is required!'));
        die();
    }
    if ($user->validate_params($_POST['lastname'])) {
        $user->lastname = $_POST['lastname'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'LastName is required!'));
        die();
    }
    if ($user->validate_params($_POST['email'])) {
        $user->email = $_POST['email'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Email is required!'));
        die();
    }
    if ($user->validate_params($_POST['phone_number'])) {
        $user->phone_number = $_POST['phone_number'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Phone Number is required!'));
        die();
    }

    if ($user->validate_params($_POST['password'])) {
        $user->password = $_POST['password'];
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Password is required!'));
        die();
    }

    // // saving picture of user
    // $user_images_folder = '../../assets/user_images/';

    // if (!is_dir($user_images_folder)) {
    //     mkdir($user_images_folder);
    // }

    // if (isset($_FILES['image'])) {
    //     $file_name = $_FILES['image']['name'];
    //     $file_tmp = $_FILES['image']['tmp_name'];
    //     $extension = end(explode('.', $file_name));

    //     $new_file_name = $user->email . "_profile" . "." . $extension;

    //     move_uploaded_file($file_tmp, $user_images_folder . "/" . $new_file_name);

    //     $user->image = 'user_images/' . $new_file_name;
    // }

    

    if (($user->check_unique_email()) && ($user->check_unique_phone_number())) {
        if ($id = $user->register_user()) {
            echo json_encode(array('success' => 1, 'message' => 'user registered!'));
        } else {
            http_response_code(500);
            echo json_encode(array('success' => 0, 'message' => 'Internal Server Error'));
        }
    } else {
        http_response_code(401);
        echo json_encode(array('success' => 0, 'message' => 'Email OR Phone Number already exists!'));
    }
} else {
    die(header('HTTP/1.1 405 Request Method Not Allowed'));
}