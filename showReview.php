<!doctype html>
<html lang="en">
<?php


require_once("elements/header.php");
?>
<body>
<?php
require_once("elements/navbar.php");
require_once("Review.php");

session_start();
if ($_SESSION['admin'] == false || !isset($_GET['review_id'])) {
    header('Location: index.php');
}

require_once 'Review.php';
$review = Review::getReview($_GET['review_id']);
if ($review == null) {
    header('Location: index.php');
}

?>

<div class="container mt-3 ">
    <div class="row ">
        <div class="col-12">
            <div class="card d-flex flex-row mt-4" style="width: 100%">
                <div>
                    <img src="<?= $review->getImagePath() ?>" class="card-img-top" alt="..." width="100" height="200">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $review->name ?></h5>
                    <p class="card-text"><?= $review->message ?></p>
                    <p class="card-text" id="status">Status: <?= $review->isActive == 1 ? 'Active' : 'Not Active' ?></p>
                    <button id="activate_btn" class="btn <?= $review->isActive == 1 ? 'btn-danger' : 'btn-success' ?>"
                    >
                        <?= $review->isActive ? 'Deactivate' : 'Activate' ?>
                    </button>
                    <button id="delete_btn" class="btn btn-danger" onclick="deleteReview()"
                    >
                        Delete
                    </button>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Edit
                    </button>

                    <form id="delete_form" class="d-none"  action="deleteReviewController.php" method="post">
                        <input type="text" name="id" value="<?= $review->id ?>" hidden>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="editReviewController.php" method="post">
                                        <div class="form-group
">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value="<?= $review->name ?>">
                                            <label for="message">Message</label>
                                            <input type="text" class="form-control" id="message" name="message"
                                                   value="<?= $review->message ?>">
                                            <input type="text" name="id" value="<?= $review->id ?>" hidden>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#activate_btn').click(function () {
        $.ajax({
            url: 'activateReviewController.php',
            type: 'POST',
            data: {
                id: <?= $review->id ?>
            },
            success: function (response) {
                let result = JSON.parse(response);
                console.log(result)
                if (result.status) {
                    $('#activate_btn').text(result.isActive == 1 ? 'Deactivate' : 'Activate');
                    $('#activate_btn').toggleClass('btn-success btn-danger');
                    $('#status').text('Status: ' + (result.isActive == 1 ? 'Active' : 'Not Active'));
                }
            }
        });
    });

    function deleteReview() {
        $('#delete_form').submit();
    }
</script>

</body>
</html>



