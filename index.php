<?php
require_once 'configs/session_start.php';
require_once 'configs/checkAuth.php';
require_once 'configs/User.php';


$userName =  User::getUserName();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'Ui/styles.php' ?>
    <title>Home | Page</title>
</head>

<body style=" background-Color: #FAF9F6;">

    <div class="container-fluid">
        <div class="row">

            <?php require_once 'Ui/navigation.php' ?>
            <div class="col mt-3 mb-5">
                <div class="row d-flex align-items-center justify-content-center">
                    <!-- post -->
                    <div class="col-lg-6 mx-lg-2 col-12 mt-3">
                        <div class="card ">
                            <p class="text-justify mt-2 text-center text-success">Login is done</p>
                        </div>
                    </div>
                    <!-- post end -->
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="comments" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="width:100% !important">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding-top: 0;">
                    <ul class="p-0" style="list-style: none;">
                        <li class="mt-4">
                            <div class="comment-header">
                                <i class="fa-regular fa-circle-user fa-lg pt-1 pe-1 fa-lg"></i>
                                Yousef Mohamed
                            </div>
                            <p class="mb-1 mt-2">آللهم اجعل القرآن الكريم ربيع قلوبنا ونور صدورنا يا رب العالمين</p>
                            <div><small><a href="#">Delete comment</a></small> | <small class="text-muted">12-1-2024</small></div>
                        </li>
                    </ul>
                    <form action="managePost.php" method="post">
                        <div class="form-floating mb-2 d-flex justify-around">
                            <input type="hidden" value="" name="post_id">
                            <input type="text" id="form3Example1c" class="form-control" placeholder="" name="comment" required />
                            <label for="floatingInput">Add comment </label>
                            <button class="btn btn-primary" type="submit">Share</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once 'Ui/scripts.php'; ?>
</body>

</html>