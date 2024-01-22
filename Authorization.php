<?php

// Include necessary files and configurations.
require_once 'configs/connection.php';
require_once 'configs/DataValidation.php';
require_once 'configs/session_start.php';

class Authorization
{
    // Use the DataValidation trait for input validation methods.
    use DataValidation;

    /**
     * Update the user's password in the database.
     *
     * @param string $email    The user's email.
     * @param string $password The new password to be hashed and stored.
     *
     * @return bool|true     Returns an error message if something goes wrong, otherwise null.
     */
    public function forgotassword($email, $password)
    {
        // check email
        if ($this->isValidEmail($email)) {
            // Hash the password using bcrypt
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            try {
                // Establish a database connection
                $connection = DBconnect();

                // Prepare the SQL statement
                $statement = $connection->prepare("UPDATE users SET PASSWORD = :password WHERE email = :email");

                // Bind parameters to the prepared statement
                $statement->bindParam(":password", $hashedPassword);
                $statement->bindParam(":email", $email);

                try {
                    // Execute the SQL statement
                    $statement->execute();

                    // Close the database connection
                    $connection = null;

                    // Return null to indicate success
                    return true;
                } catch (PDOException $exception) {
                    // Handle execution error
                    return "something went wrong";
                }
            } catch (PDOException $exception) {
                // Handle connection error
                return 'something went wrong';
            }
        } else {
            return 'not valid email';
        }
    }

    /**
     * Update basic information for a user in the database.
     *
     * @param int    $id        User ID.
     * @param string $firstName New first name.
     * @param string $lastName  New last name.
     * @param string $email     New email address.
     *
     * @return bool|string True if update is successful, 'email exists' if email is already in use, 'something went wrong' on failure.
     */
    public function updataBasicInfo($id, $firstName, $lastName, $email)
    {
        try {
            // Establish a database connection
            $connection = DBconnect();

            // Prepare SQL statement for updating user information
            $statement = $connection->prepare("UPDATE users SET first_name = :firstName , last_name = :lastName , email = :email WHERE id = :id");

            // Bind parameters to the prepared statement
            $statement->bindParam(':id', $id);
            $statement->bindParam(':firstName', $firstName);
            $statement->bindParam(':lastName', $lastName);
            $statement->bindParam(':email', $email);

            try {
                // Execute the prepared statement
                $statement->execute();
            } catch (PDOException $exception) {
                // If executing the statement fails, return 'email exists'
                return 'email exists';
            }
        } catch (PDOException $exception) {
            // If a database connection error occurs, return 'something went wrong'
            return 'something went wrong';
        }

        // Return true if the update is successful
        return true;
    }

    /**
     * Update the user's password in the database.
     *
     * @param int    $id       User ID.
     * @param string $password The new password to be hashed and stored.
     *
     * @return bool|true Returns an error message if something goes wrong, otherwise null.
     */
    public function updatePassword($id, $password)
    {
        // Hash the new password using bcrypt
        $password = password_hash($password, PASSWORD_BCRYPT);
        try {
            // Establish a database connection
            $connection = DBconnect();

            // Prepare SQL statement for updating user information
            $statement = $connection->prepare("UPDATE `users` SET `PASSWORD`=:password WHERE id = :id");

            // Bind parameters to the prepared statement
            $statement->bindParam(':id', $id);
            $statement->bindParam(':password', $password);

            // Execute the SQL statement
            $statement->execute();
        } catch (PDOException $exception) {
            // Handle any database-related errors
            return 'something went wrong';
        }

        // Return true if the update is successful
        return true;
    }

    /**
     * Delete a user from the database and destroy the session.
     *
     * @param int $id User ID.
     *
     * @return bool|string Returns an error message if something goes wrong, otherwise null.
     */
    public function destroy($id)
    {
        try {
            // Establish a database connection
            $connection = DBconnect();

            // Prepare SQL statement for deleting user by ID
            $statement = $connection->prepare("DELETE FROM users WHERE id = :id");

            // Bind parameters to the prepared statement
            $statement->bindParam(":id", $id);

            // Execute the SQL statement
            $statement->execute();

            // Close the database connection
            $connection = null;

            // Destroy the entire session, including all session variables.
            session_destroy();

            // Redirect the user to the login page after deletion
            header('location:login.php');
        } catch (PDOException $exception) {
            // Handle any database-related errors
            return 'something went wrong';
        }

        // Return true if the deletion is successful
        return true;
    }
}
