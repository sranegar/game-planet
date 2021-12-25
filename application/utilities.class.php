<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/5/2021
 * File: utilities.class.php
 * Description: This is the class named Utilties. iT contains methods for determining email format or admin access.
 */
class Utilities
{
    //validate an email address. An valid email address appears in the format of "username@domain.domain"
    public static function checkemail($email)
    {
        $result = TRUE;
        if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email)) {
            $result = FALSE;
        }
        return $result;
    }

    //validate if user is admin. Admin role = 1.
    public static function is_admin()
    {
        //start session if it has not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $role = '';

        //determine user's role
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
        }
        //return true only if the user is an administrator
        return ($role == 1) ? true : false;
    }
}