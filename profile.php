<?php
require_once 'configs/session_start.php';
require_once 'configs/checkAuth.php';
require_once 'configs/User.php';
$id = $_SESSION['userId'];
$userInfo = User::findUserById($id);

$userName =  User::getUserName();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once 'Ui/styles.php' ?>
    <style>
        .valid {
            color: #089404;
        }

        .row {
            justify-content: center !important;
        }
    </style>
    <title>Home | Page</title>
</head>

<body class=".background-radial-gradient" style="background-Color :#FAF9F6;">

    <div class="container-fluid">
        <div class="row kustify-content-center">

            <?php require_once 'Ui/navigation.php' ?>
            <div class="col mt-3 mb-5">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="p-3 p-xxl-5">
                        <!--Section heading-->
                        <h2 class="h1-responsive font-weight-bold text-center my-4">Profile Setting</h2>
                        <!--Section description-->
                        <p class="text-center w-responsive mx-auto mb-5">Amplify your profile by updating and adding more details to your information.</p>
                        <div class="container-fluid px-0">
                            <div class="row justify-content-center">
                                <div class="col-12 col-xl-8 col-xxl-9">
                                    <div class="card rounded-12 shadow-dark-80 border border-gray-50 mb-3 mb-xl-5">
                                        <div class="d-flex align-items-center px-3 px-md-4 py-3 border-bottom border-gray-200">
                                            <h5 class="card-header-title my-2 ps-md-3 font-weight-semibold">Basic Information</h5>
                                        </div>
                                        <div class="card-body px-0 p-md-4">
                                            <form class="px-3 form-style-two" action="./authorizationAction.php" method="post">
                                                <input type="hidden" name="action" value="updateBasicData">
                                                <div class="basicInfo col-12 text-center">
                                                    <?php require_once 'configs/alert.php' ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 mb-md-4 pb-3">
                                                        <label for="FullName" class="form-label form-label-lg">First Name</label>
                                                        <input type="text" name="firstName" class="form-control form-control-xl" id="firstName" placeholder="First Name" value="<?php echo $userInfo->first_name ?>">
                                                    </div>
                                                    <div class=" col-sm-6 mb-md-4 pb-3">
                                                        <label for="FullName" class="form-label form-label-lg">Last Name</label>
                                                        <input type="text" name="lastName" class="form-control form-control-xl" id="FullName" placeholder="Last Name" value="<?php echo $userInfo->last_name ?>">
                                                    </div>
                                                    <div class="col-12 mb-md-4 pb-3">
                                                        <label for="Email" class="form-label form-label-lg">Email</label>
                                                        <input type="text" name="email" class="form-control form-control-xl" id="Email" placeholder="Email" value="<?php echo $userInfo->email ?>">
                                                    </div>
                                                </div>
                                                <div class="text-end py-md-3">
                                                    <button type="submit" class="btn btn-primary px-md-4 mt-lg-3"><span class="px-md-3">Save</span></button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="card rounded-12 shadow-dark-80 border border-gray-50 mb-3 mb-xl-5">
                                        <div class="d-flex align-items-center px-3 px-md-4 py-3 border-bottom border-gray-200">
                                            <h5 class="card-header-title my-2 ps-md-3 font-weight-semibold">Manage Password</h5>
                                        </div>
                                        <div class="card-body px-0 p-md-4">
                                            <form class="px-3 form-style-two needs-validation" novalidate hx-post="./authorizationAction.php" hx-target=".updatePassword" hx-trigger="submit" hx-swap="innerHTML">
                                                <div class="updatePassword"></div>
                                                <input type="hidden" value="updatePassword" name="action">
                                                <div class="mb-md-4 pb-3">
                                                    <label for="CurrentPassword" class="form-label form-label-lg">New password</label>
                                                    <input type="text" class="form-control form-control-xl" id="CurrentPassword" placeholder="Enter New password" name="password" required>

                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        password can't be empty
                                                    </div>
                                                </div>
                                                <div class="mb-2 mb-md-4 pb-2">
                                                    <label for="NewPassword" class="form-label form-label-lg">Confirm password</label>
                                                    <input type="text" class="form-control form-control-xl" id="NewPassword" placeholder="Confirm password" value="" name="confirmPassword" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        password can't be empty
                                                    </div>
                                                </div>
                                                <div class="text-end pb-md-3 pt-md-4">
                                                    <button type="submit" class="btn btn-primary px-md-4 mt-lg-4">Change password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card rounded-12 shadow-dark-80 border border-gray-50 mb-3 pb-3">
                                        <div class="d-flex align-items-center px-3 px-md-4 py-3 border-bottom border-gray-200">
                                            <h5 class="card-header-title my-2 ps-md-3 font-weight-semibold">Delete Account</h5>
                                        </div>
                                        <div class="card-body px-0 px-md-4 py-0">
                                            <div class="px-3">
                                                <div class="media py-2 py-md-4">
                                                    <div class="media-body my-2 w-100">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <span class="fs-16">Remove account</span>
                                                                <span class="d-block small text-gray-600 mt-2">This will delete your account and all its data</span>
                                                            </div>
                                                            <div class="col-auto mt-3 mb-md-3">
                                                                <a href="authorizationAction.php?action=destroy&id=<?php echo $userInfo->id ?>" class="btn btn-danger">Delete Account</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
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
    <?php require_once 'Ui/scripts.php'; ?>
</body>

</html>