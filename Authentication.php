<?php

// Include necessary files and configurations.
require_once 'configs/connection.php';
require_once 'configs/DataValidation.php';
require_once 'configs/session_start.php';

// Define the Auth class.
class Authentication
{
    // Use the DataValidation trait for input validation methods.
    use DataValidation;

    /**
     * Finds a user in the database based on email and password.
     *
     * @param string $email    The user's email address.
     * @param string $password The user's password.
     *
     * @return object|bool Returns the user object if found, false otherwise.
     */
    private function findUser($email, $password)
    {
        // Establish a database connection.
        $connection = DBconnect();

        // check if email is valid or not
        if ($this->isValidEmail($email)) {
            // Prepare and execute a SELECT query to find the user by email.
            $statement = $connection->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(':email', $email);
            $statement->execute();

            // Fetch the user object from the result set.
            $user = $statement->fetchObject();

            // Check if the provided password matches the hashed password in the database.
            $hashedPassword = $user->PASSWORD;
            if ($this->isValidPassword($password, $hashedPassword)) {
                return $user; // User found.
            } else {
                return false; // User not found or invalid password.
            }
        } else {
            return 'not valid email';
        }
    }

    /**
     * Inserts a new user into the database.
     *
     * @param string $username       The new user's username.
     * @param string $email          The new user's email address.
     * @param string $hashedPassword The hashed password for the new user.
     *
     * @return void
     */
    private function insertNewUser($firstName, $lastName, $email, $hashedPassword)
    {
        // Establish a database connection.
        $connection = DBconnect();

        // Prepare and execute an INSERT query to add a new user to the 'users' table.
        $statement = $connection->prepare("INSERT INTO `users`(`first_name`,`last_name`, `email`, `password`) VALUES (:firstName,:lastName,:email,:password)");
        $statement->bindParam(':firstName', $firstName);
        $statement->bindParam(':lastName', $lastName);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $hashedPassword);
        $statement->execute();
    }

    /**
     * Checks if a PDOException is related to a duplicate entry in the database.
     *
     * @param PDOException $exception The exception to check.
     *
     * @return bool Returns true if it's a duplicate entry exception, false otherwise.
     */
    private function isDuplicateEntryException(PDOException $exception)
    {
        return $exception->getCode() == 23000;
    }

    /**
     * Handles user sign-up process, including input validation and database interaction.
     *
     * @param string $username The new user's username.
     * @param string $email    The new user's email address.
     * @param string $password The new user's password.
     *
     * @return bool|string Returns true on successful sign-up, error message on failure.
     */
    public function signUp($firstName, $lastName, $email, $password)
    {
        // Filter and validate the input data.
        $firstName = $this->filterInput($firstName);
        $lastName = $this->filterInput($lastName);
        $email = $this->filterInput($this->filterEmail($email));
        $password = $this->filterInput($password);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Check if the email is valid.
        if ($this->isValidEmail($email)) {
            try {
                // Attempt to insert the new user into the database.
                $this->insertNewUser($firstName, $lastName, $email, $hashedPassword);

                // The user has been successfully added.
                return true;
            } catch (PDOException $exception) {
                if ($this->isDuplicateEntryException($exception)) {
                    // Email already exists.
                    return $exception->getCode();
                } else {
                    // Other database-related exception handling.
                    throw $exception;
                }
            }
        } else {
            // Invalid email address.
            return 'Invalid email address';
        }

        return true;
    }

    /**
     * Handles user login process, including input validation and session management.
     *
     * @param string $email    The user's email address.
     * @param string $password The user's password.
     *
     * @return bool Returns true on successful login, false otherwise.
     */
    public function login($email, $password)
    {
        // Attempt to find the user in the database based on email and password.
        $user = $this->findUser($email, $password);

        // Check if the user was not found.
        if ($user === false) {
            return false; // Authentication failed.
        } elseif ($user == "not valid email") {
            return "not valid email";
        } else {
            // Regenerate the session ID for security purposes.
            session_regenerate_id();

            // Store the user's ID in the session to indicate a successful login.
            $_SESSION['userId'] = $user->id;

            return true; // Authentication successful.
        }
    }

    /**
     * Logs out the current user by destroying the session and redirecting to the login page.
     *
     * @return void
     */
    public function logout()
    {
        // Destroy the entire session, including all session variables.
        session_destroy();

        // Redirect the user to the authentication page (login page).
        header('location: login.php');
    }
}
