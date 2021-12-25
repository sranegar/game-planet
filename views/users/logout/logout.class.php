<?php

/**
 * Author: Collin Hill
 * Date: 12/6/2021
 * File: logout.class.php
 * Description: This is the View class for the logout page. IT tels the user if they have logged out of hte system.
 */
class Logout extends IndexView
{
    public function display()
    {
        parent::displayHeader("Logout");
        ?>
        <div class="top-row">Login</div>
        <div class="form-wrapper">
            <div class="middle-row">
                <br>
                <h2>You have successfully logged out.</h2>
                <form method="post" action="<?= BASE_URL ?>/user/verify">
                    <div><input id="form" type="text" name="username" style="width: 99%" placeholder="Username"
                                autocomplete="off"></div>
                    <div><input id="form" type="password" name="password" style="width: 99%" placeholder="Password"
                                autocomplete="off"></div>
                    <br>
                    <input type="submit" style="height: 40px;" class="cart-button" value="Login"">
                </form>
                <h4 style="text-align: center; font-family: 'Arial Narrow'; opacity: 70%;">OR</h4>
                <form method="post" action="<?= BASE_URL ?>/user/create_account">
                    <input type="submit"
                           class="secondary-button" value="Create Account"">
                </form>
            </div>
        </div>

        <?php
        parent::displayFooter();
    }
}