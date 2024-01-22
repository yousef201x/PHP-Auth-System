<?php require_once 'configs/session_start.php';
require_once 'configs/checkAuth.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'Ui/styles.php' ?>
    <style>
        .inValid {
            color: red;
        }
    </style>
    <title id="title">Signup | page</title>
</head>

<body class="background-radial-gradient overflowx-hidden">
    <!-- Section: Design Block -->
    <section>

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
                            <h1 class="h3 mb-3 fw-normal">Signup Form</h1>
                            <div class="problem" style="height:35px !important;">
                                <?php require_once 'configs/alert.php' ?>
                            </div>

                            <form class="needs-validation" action="authenticationAction.php" method="post" novalidate>

                                <input type="hidden" name="action" value="signup">

                                <div class="form-outline mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="last_name" placeholder="Enter First Name" name="first_name" required>
                                        <label for="email">First Name</label>
                                        <div class="valid-feedback">
                                            First Name is provided
                                        </div>
                                        <div class="invalid-feedback">
                                            First Name can't be empty
                                        </div>
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" required>
                                        <label for="email">Last Name</label>
                                        <div class="valid-feedback">
                                            Last Name is provided
                                        </div>
                                        <div class="invalid-feedback">
                                            Last Name can't be empty
                                        </div>
                                    </div>
                                </div>

                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="email" placeholder="Enter Email" name="signup_email" required>
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
                                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="signup_password" required>
                                        <label for="password">Password</label>
                                        <div class="valid-feedback">
                                            Password is provided
                                        </div>
                                        <div class="invalid-feedback">
                                            Password can't be empty
                                        </div>
                                    </div>
                                </div>

                                <div class="have-account text-center mb-2">
                                    <a href="login.php" class="nav-link">Already Have account ?</a>
                                </div>

                                <!-- Submit button -->
                                <input type="submit" class="btn btn-primary col-12" value="Login" />

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