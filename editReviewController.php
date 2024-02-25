<?php


session_start();
if ($_SESSION['admin'] == false) {
    http_response_code(401);
    die();
}
if (!isset($_POST['id']) || !isset($_POST['name']) || !isset($_POST['message'])) {
    http_response_code(400);
    die();
}

require_once 'Review.php';
$review = Review::getReview($_POST['id']);
$review->name = $_POST['name'];
$review->message = $_POST['message'];
$review->isChanged = 1;
//$review->isActive = !$review->isActive;
$review->updateReview();
header('Location: showReview.php?review_id=' . $_POST['id']);
