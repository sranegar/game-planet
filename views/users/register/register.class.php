<?php

/**
 * Author: Melissa Boyer
 * Date: 12/6/2021
 * File: register.class.php
 * Description: This is the View class that confirms if a user has created an account.
 */
class Register extends IndexView
{
    public function display($result)
    {
        parent::displayHeader("Register");

        ?>
            <div class="top-row">CREATE AN ACCOUNT</div>
        <div class="form-wrapper">
            <div class="middle-row">
                <br>
            <h2><?= $result ?></h2>

            <?php
            if (strpos($result, "successful") == true) {
                ////the user's last login attempt succeeded. details the logout button
                echo "<br><br><a href=" . BASE_URL . "/cart/holding/><button value='Cart' class='cart-button'>View Account</button></a>";
                echo "<h4 style='text-align: center; opacity: 70%;  font-family: Arial Narrow'>OR</h4>";
                echo "<a href=" . BASE_URL . "/user/logout><button value='Logout' class='secondary-button'>LOGOUT</button></a>";
            } else { //if the user has not logged in, details the login button
                echo "<form method='post' action=" . BASE_URL . "/user/register>";
                echo "<div><input id='form' type='text' name='username' style='width: 99%' placeholder='Username' autocomplete='off'></div><br>";
                echo "<div><input id='form' type='password' name='password' style='width: 99%' placeholder='Password, 5 characters minimum' autocomplete='off'></div><br>";
                echo "<div><input id='form' type='text' name='email' style='width: 99%' placeholder='Email' autocomplete='off'></div><br>";
                echo "<div><input id='form' type='text' name='fname' style='width: 99%' placeholder='First name' autocomplete='off'></div><br>";
                echo "<div><input id='form' type='text' name='lname' style='width: 99%' placeholder='Last name' autocomplete='off'></div><br>";
                echo "<input class='cart-button' type='submit' value='Register'>";
                echo "</form>";
                echo "<h4 style='text-align: center; opacity: 70%;  font-family: Arial Narrow'>OR</h4>";
                echo "<a href=" . BASE_URL . "/user/login><button value='Login' class='secondary-button'>LOGIN</button></a>";
            }
            ?>

        </div>
        </div>
        <?php
        parent::displayFooter();
    }
}