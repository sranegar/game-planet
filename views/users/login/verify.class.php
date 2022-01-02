<?php

/**
 * Author: Jacob Wells
 * Date: 12/6/2021
 * File: verify.class.php
 * Description: This is the View class that verifies if a user has been logged into the system.
 */
class Verify extends IndexView
{
    public function display($result)
    {
        parent::displayHeader("Login");
        ?>
        <div class="top-row">Login</div>
        <div class="form-wrapper">
            <div class="middle-row">
               <br>
                <h2><?= $result ?></h2>
        <?php
        if (strpos($result, "successful") == true) {
            ////the user's last login attempt succeeded. details the logout button
            echo "<br><br><a href=" . BASE_URL . "/cart/holding><button value='Cart' class='cart-button'>Shopping Cart</button></a>";
            echo "<h4 style='text-align: center; font-family: Arial Narrow; opacity: 70%;'>OR</h4>";
            echo "<a href=" . BASE_URL . "/user/logout><button value='Logout' class='secondary-button'>LOGOUT</button></a>";
        } else { //if the user has not logged in, details the login button
            echo "<form method='post' action=" . BASE_URL . "/user/verify>";
            echo "<div><input method='post' id='form' type='text' name='username' style='width: 99%' placeholder='Username' autocomplete='off'></div>";
            echo "<div><input method='post' id='form' type='password' name='password' style='width: 99%' placeholder='Password' autocomplete='off'></div><br>";
            echo "<input type='submit' style='height: 40px' class='cart-button' value='Login'>";
            echo "</form>";
            echo "<h4 style='text-align: center; font-family: Arial Narrow; opacity: 70%;'>OR</h4>";
            echo "<a href=" . BASE_URL . "/user/create_account><button value='Create Account' class='secondary-button'>CREATE ACCOUNT</button></a>";

        }
        ?>


            </div>
        </div>
        <?php
        parent::displayFooter();
    }

}