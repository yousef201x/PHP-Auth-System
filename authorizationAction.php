<?php
require_once 'Authorization.php';
require_once 'configs/User.php';

// Function to redirect to a specified path
function redirect($path)
{
    header("Location: " . $path);
    exit();
}

// Get the referring page's path
$lastPath = $_SERVER['HTTP_REFERER'];

// Set your default redirect path here
$defaultRedirectPath = $lastPath . "?action=invalid&status=Internal server error";

// Check if the form action is 'updatePassword'
if (!empty($_POST['action']) && $_POST['action'] === 'forgotPassword') {

    // Check if email and newPassword fields are not empty
    if (!empty($_POST['email']) && !empty($_POST['newPassword'])) {
        $email = $_POST['email'];

        // Check if the user with the provided email exists
        if (User::findUserByEmail($email)) {
            $password = $_POST['newPassword'];

            // Create an Auth object and update the user's password
            $updatedPassword = new Authorization;
            $result = $updatedPassword->forgotassword($email, $password);

            // Check the result of the password update and redirect accordingly
            if ($result === true) {
                redirect("login.php?action=valid&status=password changed");
            } else {
                redirect("login.php?action=invalid&status=something wrong try again");
            }
        } else {
            // Redirect if the user with the provided email is not found
            redirect("login.php?action=invalid&status=user not found");
        }
    } else {
        // Redirect if email or newPassword fields are empty
        redirect("login.php?action=invalid&status=action failed, Required values");
    }
} elseif (!empty($_POST['action']) && $_POST['action'] === 'updateBasicData') {
    if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_SESSION['userId'])) {

        $id = $_SESSION['userId'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];

        $action = new Authorization;
        $result = $action->updataBasicInfo($id, $firstName, $lastName, $email);
        if ($result === true) {
            redirect("profile.php?action=valid&status=Your data has been updated successfully ");
        } elseif ($result == "email exists") {
            redirect("profile.php?action=invalid&status=Email already in use");
        }
    } else {
        redirect("profile.php?action=invalid&status=Something went wrong");
    }
}
// Check if the form was submitted and the action is to update basic data
elseif (!empty($_POST['action']) && $_POST['action'] === 'updateBasicData') {

    // Check if the required form fields are not empty and user is authenticated
    if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_SESSION['userId'])) {

        // Extract values from the form data
        $id = $_SESSION['userId'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];

        // Create an instance of the Auth class
        $action = new Authorization;
        // Call the method to update basic information and get the result
        $result = $action->$action->updataBasicInfo($id, $firstName, $lastName, $email);

        // Check the result of the update operation
        if ($result === true) {
            // If the update was successful, redirect with a success message
            redirect("profile.php?action=valid&status=Your data has been updated successfully");
        } elseif ($result == "email exists") {
            // If the email already exists, redirect with an error message
            redirect("profile.php?action=invalid&status=Email already in use");
        }
    } else {
        // If required fields are not provided or something went wrong, redirect with an error message
        redirect("profile.php?action=invalid&status=Something went wrong");
    }
} elseif (!empty($_POST['action']) && $_POST['action'] === 'updatePassword') {
    if (!empty($_POST['password']) && !empty($_POST['confirmPassword']) && !empty($_SESSION['userId'])) {
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $id = $_SESSION['userId'];
        if ($password === $confirmPassword) {
            $action = new Authorization;
            $result = $action->updatePassword($id, $password);

            if ($result === true)
                echo "<p class='valid'>Password changed</p>";
            else
                echo "<p class='notValid'>Something went wrong</p>";
        } else {
            echo "<p class='notValid'>Passwords doesn't match</p>";
        }
    } else {
        echo "<p class='notValid'>Required values</p>";
    }
} elseif ($_GET['action'] == 'destroy') {
    if (!empty($_GET['id'])) {
        $id = $_GET['id'];

        $action = new Authorization;
        $result = $action->destroy($id);

        if ($result == 'something went wrong') {
            redirect($lastPath);
        }
    }
} else {
    // Redirect for invalid form action
    redirect($lastPath . "?action=invalid&status=internal server error");
}
