<?php
require_once 'Review.php';
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    session_start();
    $_SESSION['admin'] = false;
    http_response_code(400);
    die();
}

if ($_POST['email'] == 'admin@gmail.com' && $_POST['password'] == 'admin') {
    session_start();
    $_SESSION['admin'] = true;
    $result['status'] = true;
    $reviews = Review::getReviews();
    $result['reviews'] = $reviews;
    echo json_encode($result);
    http_response_code(200);
    die();

} else {
    session_start();
    $_SESSION['admin'] = false;
    $result['status'] = false;
    echo json_encode($result);
    http_response_code(401);
    die();
}


