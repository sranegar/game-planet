<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/7/2021
 * File: user_controller.class.php
 * Description: This file defines a clas named UserController. iT defines a method for all applications logic and organization.
 */
class UserController
{
    private $user_model;

    //default constructor
    public function __construct()
    {
        //create an instance of the GameModel class
        $this->user_model = UserModel::getUserModel();

        //if the use has logged in, retrieve login, name, and role.
        if (isset($_SESSION['login']) and isset($_SESSION['firstname']) and
            isset($_SESSION['role'])) {
            $login = $_SESSION['login'];
            $firstname = $_SESSION['firstname'];
            $role = $_SESSION['role'];
        }
    }

    //details the login form
    public function login()
    {
        $view = new Login();
        $view->display();
    }

    //details the registration form.
    public function create_account()
    {
        $view = new CreateAccount();
        $view->display();
    }

    //create a user account by calling the addUser method of a userModel object
    public function register()
    {
        //call the addUser method of the UserModel object
        $result = $this->user_model->add_user();

        //details result
        $view = new Register();
        $view->display($result);
    }

    //verify username and password by calling the verify_user method defined in the model.
    public function verify()
    {
        //call the verify_user method of the UserModel object
        $result = $this->user_model->verify_user();

        //details result
        $view = new Verify();
        $view->display($result);
    }

    //log out a user by calling the logout method defined in the model
    public function logout()
    {
        $this->user_model->logout();
        $view = new Logout();
        $view->display();
    }

    public function admin()
    {
        try {
            if (!Utilities::is_admin()) {
                throw new Exception();
            }

            //create instance of AdminView
            $view = new Admin();
            $view->display();
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("Administrator access only.");
        }
    }
}