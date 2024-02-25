<?php

session_start();
if ($_SESSION['admin'] == false) {
    http_response_code(401);
    die();
}

require_once 'Review.php';
$review = Review::getReview($_POST['id']);
$review->isActive = !$review->isActive;
$review->updateReview();
$result['status'] = true;
$result['isActive'] = $review->isActive;
//$result['review'] = $review;
echo json_encode($result);
http_response_code(200);