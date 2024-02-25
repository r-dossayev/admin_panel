<?php

session_start();
if ($_SESSION['admin'] == false) {
    http_response_code(401);
    die();
}

require_once 'Review.php';
$reviews = Review::getReviews();
echo json_encode($reviews);
http_response_code(200);




