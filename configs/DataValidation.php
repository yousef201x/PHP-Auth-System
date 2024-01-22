<?php

// Define a trait named "DataValidation".
trait DataValidation
{
    /**
     * Filters and sanitizes input data to prevent common security issues.
     *
     * @param string $value The input value to be filtered.
     *
     * @return string The filtered and sanitized input value.
     */
    function filterInput(string $value)
    {
        return htmlspecialchars(trim($value));
    }

    /**
     * Filters and sanitizes an email address to prevent common security issues.
     *
     * @param string $email The email address to be filtered.
     *
     * @return string The filtered and sanitized email address.
     */
    function filterEmail(string $email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Validates whether an email address is in a valid format.
     *
     * @param string $email The email address to be validated.
     *
     * @return bool Returns true if the email address is valid, false otherwise.
     */
    function isValidEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Verifies whether a plain-text password matches its hashed counterpart.
     *
     * @param string $password        The plain-text password.
     * @param string $hashed_password The hashed password to compare against.
     *
     * @return bool Returns true if the password is valid, false otherwise.
     */
    function isValidPassword($password, $hashed_password)
    {
        return password_verify($password, $hashed_password);
    }
}
