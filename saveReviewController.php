<?php


require_once 'helpers.php';
require_once 'Review.php';

if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message']) || !isset($_FILES['image'])) {
    $errors['error'] = 'All fields are required';
    echo json_encode($errors);
    http_response_code(400);
    die();
}
$errors['email'] = checkEmail($_POST['email']);
$errors['image'] = fileValidator($_FILES['image']);

foreach ($errors as $error) {
    if (!empty($error)) {
        echo json_encode($errors);
        http_response_code(400);
        die();
    }
}

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $image = attachFile($_FILES['image']);
    $result = new Review(0, $name, $email, $message, $image, 0);
    $result = $result->save();
    echo json_encode($result);
    http_response_code(200);
    die();

