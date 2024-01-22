<?php
require_once 'configs/connection.php';
require_once 'configs/DataValidation.php';

// Define a trait named "User".
trait User
{
    use DataValidation;

    /**
     * Finds a user in the database by user ID.
     *
     * @param int $id The user ID to search for.
     *
     * @return object|false Returns the user object if found, false otherwise.
     */
    static function findUserById($id)
    {
        // Retrieve the hashed user ID from the session (assuming it's used for security).
        $hashedId = $_SESSION['userId'];

        // Establish a database connection.
        $connection = DBconnect();

        // Prepare and execute a SELECT query to find the user by ID.
        $statement = $connection->prepare("SELECT * FROM users WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();

        // Fetch the user object from the result set.
        $user = $statement->fetchObject();

        // Return the user object or false if not found.
        return $user;
    }

    /**
     * Get the full name of the user based on the session user ID.
     *
     * @return string The full name of the user.
     */
    static function getUserName()
    {
        $id = $_SESSION['userId'];
        $user = User::findUserById($id);
        $firstName = $user->first_name;
        $lastName = $user->last_name;
        return "$firstName $lastName";
    }

    /**
     * Check if the given email is a valid email format.
     *
     * @param string $email The email to validate.
     *
     * @return bool Returns true if the email is valid, false otherwise.
     */
    static function isValidEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Check if a user with the given email exists in the database.
     *
     * @param string $email The email to search for.
     *
     * @return bool Returns true if the user exists, false otherwise.
     */
    static function findUserByEmail($email)
    {
        // Establish a database connection.
        $connection = DBconnect();

        // Check if the email is valid.
        if (User::isValidEmail($email)) {
            // Prepare and execute a SELECT query to find the user by email.
            $statement = $connection->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(':email', $email);
            $statement->execute();

            // Fetch the result object and return true if found, false otherwise.
            $result = $statement->fetchObject();
            return !empty($result);
        }

        // Return false if the email is not valid.
        return false;
    }
}
