<!doctype html>
<html lang="en">
<?php
require_once("elements/header.php");
?>
<body>
<?php
require_once("elements/navbar.php");
?>

<div class="container mt-3 ">
    <div class="row d-flex flex-row justify-content-center">
        <div class="col-md-6">
            <h1>Callback Form</h1>

            <div id="alert" class="alert alert-danger d-none" role="alert">
                <ul id="errorList">
                </ul>
            </div>
            <form id="review_form" class="mt-2" method="post" action="saveReviewController.php" enctype="multipart/form-data">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="form3Example2">Name</label>
                            <input type="text" id="form3Example2"  name="name" class="form-control"/>
<!--                            <div class="form-text text-danger">error message</div>-->

                        </div>
                    </div>
                </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form3Example3">Email address</label>
                    <input name="email" type="email" id="form3Example3" class="form-control"/>
<!--                    <div class="form-text text-danger">error message</div>-->

                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form3Example4">Message</label>
                    <textarea id="form3Example4" class="form-control" name="message" cols="30" rows="2">

                    </textarea>
<!--                    <div class="form-text text-danger">error message</div>-->

                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <input name="image" type="file" id="form3Example7" class="form-control"/>
                </div>


                <!-- Submit button -->
                <button id="submitBtn" data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Submit</button>

            </form>

        </div>
    </div>
</div>


    <script>
        const form = document.getElementById('review_form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const response = await fetch('saveReviewController.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (response.ok) {
                console.log(result);
                form.reset();
                alert('Review added successfully')
            }else {

                const alert = document.getElementById('alert');
                const errorList = document.getElementById('errorList');
                errorList.innerHTML = '';
                for (const key in result) {
                    const li = document.createElement('li');
                    li.innerText = result[key];
                    errorList.appendChild(li);
                }
                alert.classList.remove('d-none');
            }
            console.log(result);
        });
</script>
</body>
</html>
