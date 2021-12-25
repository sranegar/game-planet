<?php

/**
 * Author: Melissa Boyer
 * Date: 12/6/2021
 * File: create_account.class.php
 * Description: This is the View class for creating an account. IT contains a form that allows a user to register an account to the system.
 */
class CreateAccount extends IndexView
{
    public function display()
    {
        parent::displayHeader("Create Account");

        ?>
            <div class="top-row">Create an Account</div>
        <div class="form-wrapper">
            <div class="middle-row">
                <br>
                <h2>Please complete the entire form. All fields are required.</h2>
                <form method="post" action="<?= BASE_URL ?>/user/register">
                    <!-- Form for creating an account -->
                    <div><input id="form" type="text" name="username" style="width: 99%" placeholder="Username"
                                autocomplete="off"></div>
                    <br>
                    <div><input id="form" type="password" name="password" style="width: 99%"
                                placeholder="Password, 5 characters minimum" autocomplete="off"></div>
                    <br>
                    <div><input id="form" type="text" name="email" style="width: 99%" placeholder="Email"
                                autocomplete="off"></div>
                    <br>
                    <div><input id="form" type='text' name="fname" style="width: 99%" placeholder="First name"
                                autocomplete="off"></div>
                    <br>
                    <div><input id="form" type="text" name="lname" style="width: 99%" placeholder="Last name"
                                autocomplete="off"></div>
                    <br>
                    <div><input class="cart-button" type="submit" value="Register"></div>
                    <h4 style="text-align: center; font-family: 'Arial Narrow'; opacity: 70%;">OR</h4>
                </form>
                <a href="<?= BASE_URL ?>/user/login"><button value='Login' class='secondary-button'>LOGIN</button></a>
                <br>
            </div>
        </div>

        <?php
        parent::displayFooter();
    }

}