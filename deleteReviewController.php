<?php

session_start();
if ($_SESSION['admin'] == false || !isset($_POST['id'])) {
    http_response_code(401);
    die();
}

require_once 'Review.php';
$review = Review::getReview($_POST['id']);
$review->isDeleted = 1;
$review->updateReview();

header('Location: showReview.php?review_id=' . $_POST['id']);

