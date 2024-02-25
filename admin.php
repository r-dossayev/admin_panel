
<html lang="en">
<?php


require_once("elements/header.php");
?>
<body>
<?php
require_once("elements/navbar.php");
require_once("Review.php");
$reviews = Review::getReviews();
$admin_email = "admin@gmail.com";
$admin_password = "admin";
?>

<div class="container mt-3 ">
    <div class="row ">
        <div class="col-12">
            <h1>Admin Panel</h1>
            <div class="row ">
                <div class="col-12">
                    <div id="reviews" class="mt-3">
                </div>
                </div>

            <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>

                        </div>
                        <div class="modal-body">
                            <form id="check_admin" action="">
                                <input type="text" class="form-control" placeholder="email">
                                <input type="password" class="form-control" placeholder="password">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
 // admin login prompt


    $(document).ready(function () {
        let modal = new bootstrap.Modal(document.getElementById('modal'));
        modal.show();
        $('#check_admin').submit(function (e) {
            e.preventDefault();
            let email = $(this).find('input[type="text"]').val();
            let password = $(this).find('input[type="password"]').val();
            $.ajax({
                url: 'adminCheckController.php',
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function (response) {
                    console.log(response);
                    let result = JSON.parse(response);
                    if (result.status) {
                        let reviews = result.reviews;
                        reviews.forEach(review => {
                            $('#reviews').append(reviewCard(review));
                        });
                        modal.hide();

                    }
                },
                error: function (response) {
                    window.location.href = 'index.php';
                }
            });
        });
    });
        const reviewCard = (review) => {
        return `
       <div class="card d-flex flex-row mt-4" style="width: 100%">
              <div>
                  <img src="uploads/${review.image}" class="card-img-top" alt="..." width="100" height="200">
              </div>
              <div class="card-body">
                  <h5 class="card-title">${review.name}</h5>
                  <p class="card-text">${review.message}</p>
                  <p class="card-text">Status: ${review.isActive? 'Active': 'Not Active'}</p>
                  <a href="showReview.php?review_id=${review.id}" class="btn btn-primary">Show</a>
              </div>
          </div>
        `;

        }

</script>



</body>
</html>
