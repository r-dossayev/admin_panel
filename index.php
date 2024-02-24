<!doctype html>
<html lang="en">
<?php


require_once("elements/header.php");
?>
<body>
<?php
require_once("elements/navbar.php");
require_once("Review.php");
$reviews = Review::getReviews();
?>

<div class="container mt-3 ">
    <div class="row ">
      <div class="col-12">
          <?php
          foreach ($reviews as $review) {

          ?>
          <div class="card d-flex flex-row mt-4" style="width: 100%">
              <div>
                  <img src="<?=$review->getImagePath() ?>" class="card-img-top" alt="..." width="100" height="200">
              </div>
              <div class="card-body">
                  <h5 class="card-title"><?=$review->name ?></h5>
                  <p class="card-text"><?=$review->message ?></p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
          </div>
            <?php
            }
            ?>

      </div>
    </div>
</div>



</body>
</html>
