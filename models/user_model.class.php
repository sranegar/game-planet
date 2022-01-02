<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/7/2021
 * File: user_model.class.php
 * Description: This script contains the application Model named UserModel class
 */
class UserModel
{
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblUser;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getUserModel method must be called.
    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblUser = $this->db->getUserTable();

        //start session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

    }

    //static method to ensure there is just one UserModel instance
    public static function getUserModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }

    //handle an error
    public function error($message)
    {

        //create an object of the Error class
        $error = new GameError();
        //details the error page
        $error->display($message);
    }

    //add a user into the "users" table in the database
    public function add_user()
    {

        //retrieve user inputs from the registration form
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $lastname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_STRING);
        $firstname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        try {
            //determine if any of the form fields were left blank
            if ($username == "" || $password == "" || $lastname == "" || $firstname == "" || $email == "") {
                //throw exception if data is missing
                throw new DataMissingException ("Values are missing in one or more fields. All fields must be filled.");
            }
            //determine password is at least 5 characters in length
            if (strlen($password) < 5) {
                throw new DataLengthException("Your password is invalid. The minimum length of a password is 5 characters.");
            }
            //determine email format by calling static check email method from Utilities class
            if (!Utilities::checkemail($email) && !$email == "") {
                throw new EmailFormatException("Your email format was invalid. The general format of an email address is user@example.com.");
            }
            //hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //set user's role
            $role = 2;

            //construct an INSERT query
            $sql = "INSERT INTO " . $this->db->getUserTable() . " VALUES(NULL, '$username', '$hashed_password', '$email', '$firstname', '$lastname', '$role')";

            //execute the query and return true if successful or false if failed
            if ($this->dbConnection->query($sql) === FALSE) {
                throw new DatabaseException("We are sorry, but we can't create your account at this moment. Please try again later.");
            }
            return "Your account has been successfully created.";
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DataLengthException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (EmailFormatException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //verify username and password against a database record
    public function verify_user()
    {
        //retrieve username and password
        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

        try {
            //determine if any of the form fields were left blank
            if ($username == "" || $password == "") {
                //throw exception if data is missing
                throw new DataMissingException("Values are missing in one or more fields. All fields must be filled.");
            }
            //sql statement to filter the users table data with a username
            $sql = "SELECT password, firstname, role FROM " . $this->db->getUserTable() . " WHERE username='$username'";

            //execute the query
            $query = $this->dbConnection->query($sql);

            //verify password; if password is valid, set a temporary cookie
            if ($query and $query->num_rows > 0) {
                $row = $query->fetch_assoc();
                //store hashed password
                $hash = $row['password'];
                if (password_verify($password, $hash)) {
                    setcookie("user", $username);
                    //store user in session variables
                    $_SESSION['login'] = $username;
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['login_status'] = 1;
                    return "You have successfully logged in as " . $username . ".";
                }
            } else {
                //if username and/or password is not valid, throw Exception object
                throw new DatabaseException("Your username and/or password were invalid. Please try again.");
            }
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    //logout user: destroy session data
    public function logout()
    {
        //start session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        //unset all the session variables
        $_SESSION = array();
        //delete the session cookie
        setcookie(session_name(), "", time() - 3600);
        //destroy the session
        session_destroy();
    }
}