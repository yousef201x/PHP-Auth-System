<?php
require_once 'Authentication.php';

// Function to redirect to a specified path and exit further execution
function redirect($path)
{
    header("Location: " . $path);
    exit();
}

// Get the referring page's path
$lastPath = $_SERVER['HTTP_REFERER'];

// Set your default redirect path here
$defaultRedirectPath = $lastPath . "?action=invalid&status=Internal server error";

// Check if the 'action' parameter is present in the POST data
if (!empty($_POST['action'])) {
    $action = $_POST['action'];

    // Switch statement for different actions
    switch ($action) {
        case "signup":
            // Check if required signup form fields are not empty
            if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['signup_email']) && !empty($_POST['signup_password'])) {
                $firstName = $_POST['first_name'];
                $lastName = $_POST['last_name'];
                $email = $_POST['signup_email'];
                $password = $_POST['signup_password'];

                // Additional processing for signup...
                $signup = new Authentication;

                // Try signing up the user
                try {
                    $signupResult = $signup->signUp($firstName, $lastName, $email, $password);
                    // Check if email is already in use
                    if ($signupResult === 'Invalid email address') {
                        redirect($lastPath . "?action=invalid&status=failed action, not valid email address");
                    } elseif ($signupResult === "23000") {
                        redirect($lastPath . "?action=invalid&status=failed action, Email already in use");
                    } else {
                        //Try logging in the user after successful signup
                        try {
                            $loginResult = $signup->login($email, $password);

                            // Redirect based on login success or failure
                            if ($loginResult === true) {
                                redirect("index.php");
                            } else {
                                redirect("login.php");
                            }
                        } catch (PDOException $exception) {
                            // Redirect in case of login failure due to server issues
                            redirect($lastPath . "?action=invalid&status=failed action, Server is down");
                        }
                    }
                } catch (PDOException $exception) {
                    // Redirect in case of signup failure due to server issues
                    redirect($lastPath . "?action=invalid&status=failed action, Server is down");
                }
            } else {
                // Redirect if required signup form fields are empty
                redirect($lastPath . "?action=invalid&status=failed action, Required Values");
            }
            break;

        case 'login':
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $login = new Authentication;
                $loginResult = $login->login($email, $password);
                if ($loginResult === true) {
                    redirect("index.php");
                } elseif ($loginResult == "not valid email") {
                    redirect($lastPath . "?action=invalid&status=not valid email address");
                } else {
                    redirect($lastPath . "?action=invalid&status=User not found");
                }
            } else {
                redirect($lastPath . "?action=invalid&status=failed action, Required Values");
            }
            break;
    }
} elseif (!empty($_GET['action']) && $_GET['action'] === 'logout') {
    $logout = new Authentication;
    $logout->logout();
} else {
    // Redirect to the default path if 'action' parameter is not present in POST data
    redirect($defaultRedirectPath);
}
