<?php require_once 'configs/session_start.php';
require_once 'configs/checkAuth.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'Ui/styles.php' ?>
    <title id="title">Login | page</title>
</head>

<body class="background-radial-gradient overflowx-hidden">
    <!-- Section: Design Block -->
    <section class="pb-5">

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start ">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-2 mb-lg-0" style="z-index: 10">
                    <h1 class="my-3 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        The best offer <br />
                        <span style="color: hsl(218, 81%, 75%)">for your security</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Xmedia is a cutting-edge open-source application designed to empower users to share engaging interactive posts and comments seamlessly.
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
                    <div class="card bg-glass">
                        <div class="card-body px-4 py-5 px-md-5">
                            <h1 class="h3 mb-3 fw-normal">Login Form</h1>
                            <div class="problem" style="height:35px !important;">
                                <?php require_once 'configs/alert.php' ?>
                            </div>

                            <form class="needs-validation" action="authenticationAction.php" method="post" novalidate>
                                <input type="hidden" name="action" value="login">
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" required>
                                        <label for="email">Email</label>
                                        <div class="valid-feedback">
                                            Email is provided
                                        </div>
                                        <div class="invalid-feedback">
                                            Email can't be empty
                                        </div>
                                    </div>
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password" placeholder="password" name="password" required>
                                        <label for="password">Password</label>
                                        <div class="valid-feedback">
                                            Password is provided
                                        </div>
                                        <div class="invalid-feedback">
                                            Password can't be empty
                                        </div>
                                    </div>
                                </div>

                                <div class="have-account text-center">
                                    <a href="#" class="nav-link my-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Forgot Password ?</a>
                                </div>

                                <!-- Submit button -->
                                <input type="submit" class="btn btn-primary col-12" value="Login" />
                                <div class="col-12 text-center mb-1">
                                    <a href="signup.php" class="nav-link">Don't Have account ?</a>
                                </div>
                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>Inspect source code on GitHub</p>

                                    <a href="https://github.com/yousef201x/xMedia" target="_blank" class="btn btn-link btn-floating mx-1" style="color:black">
                                        <i class="fab fa-github fa-xl"></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <form action="authorizationAction.php" method="post">
        <div class="modal fade background-radial-gradient" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" value="forgotPassword" name="action">
                        <div class="form-outline mb-4">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                                <label for="floatingInput">Account Email address</label>
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="newPassword">
                                <label for="floatingInput">New Password</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">change Password</button>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <?php require_once 'Ui/scripts.php' ?>
</body>

</html>