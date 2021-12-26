<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/26/2021
 * File: welcome_index_view.class.php
 * Description:
 */
class WelcomeIndexView
{
    //this method displays the page header
    static public function displayHeader($page_title)
    {


        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        //variables for a user's login, name, and role
        $login = '';
        $count=0;

        //retrieve cart content
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            if ($cart) {
                $count = array_sum($cart);
            }
        }


        //if the use has logged in, retrieve login, name, and role.
        if (isset($_SESSION['login']) AND isset($_SESSION['firstname']) AND
            isset($_SESSION['role'])) {
            $login = $_SESSION['login'];
            $firstname = $_SESSION['firstname'];
            $role = $_SESSION['role'];
        }


        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title><?php echo $page_title ?></title>
            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
            <link type='text/css' rel='stylesheet' href='<?= BASE_URL ?>/www/css/app_style.css'/>
            <link rel="icon" type="image/png" href="img/icon.png">
            <link rel="shortcut icon" type="image/x-icon" href='<?= BASE_URL ?>/www/img/favicon.ico' />
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src='<?= BASE_URL ?>/www/js/main.js'></script>
            <script>
                //create the JavaScript variable for the base url
                var base_url = "<?= BASE_URL ?>";
                //JavaScript variable for media type
                var media = "game";
            </script>
        </head>
        <body>
        <div class="banner">
            <?php
            if (!empty($login) && $role == 1) {
                ?>
                <div class="dropdown" style="padding: 20px">
                    <a href="" class='shop-link'
                       style='text-decoration: none; font-size: 13px; color: #fff; padding: 10px; font-family: Helvetica'>Admin
                        Rights</a>
                    <div class="dropdown-admin-content">
                        <a href="<?= BASE_URL ?>/game/add_form">Add Game</a>
                        <a href="<?= BASE_URL ?>/system/add_form">Add Console</a>
                        <a href="<?= BASE_URL ?>/game/index">Edit Game</a>
                        <a href="<?= BASE_URL ?>/system/index">Edit Console</a>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php
            if (!empty($login) && $role == 2) {
                ?>
                <div style="padding: 20px">
                    <p style="color: #fff; opacity: 85%; margin-top: 20px; font-family: Helvetica; font-size: 13px;">Welcome back, <?= $firstname ?>!</p>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="web-container">
        <div class="top-links">
            <div class="dropdown">
                <p
                    style='text-decoration: none; margin-left: 10px; font-size: 20px; color: black; margin-top: 25px; font-family: Helvetica'>Shop</p>
                <div class="dropdown-content">
                    <h3>Shop By Category</h3>
                    <a href="<?= BASE_URL ?>/game/index">Video Games</a>
                    <a href="<?= BASE_URL ?>/system/index">Game Consoles</a>
                </div>
            </div>
            <div>
                <a href="<?= BASE_URL ?>/welcome/index"><img style="margin-top: 8px; margin-left: 35px;  width: 200px; height:55px"
                                                             src="<?= BASE_URL ?>/www/img/game_planet_logo.jpg"></a>
            </div>
            <div class="search-bar">
                <form method="get" action="<?= BASE_URL ?>/game/search">
                    <input id="search" name="query-terms" type="text"
                           placeholder="Search Games by Title..."
                           onkeyup="handleKeyUp(event)" autocomplete="off">
                    <button type="submit" class="search-button">
                        <img src="<?= BASE_URL ?>/www/img/search.png">
                    </button>
                </form>
            </div>
            <div class="right-links">

                <!-- create link for login/register page -->
                <?php
                if (empty($login)) {
                    ?>

                    <a href="<?= BASE_URL ?>/user/login" style='text-decoration: none;  margin-left: 80px; font-size: 16px; color: black;
                font-family: Helvetica'>Login</a>
                    <?php
                } else {
                    ?>

                    <a href="<?= BASE_URL ?>/user/logout" style='text-decoration: none; margin-left: 80px; font-size: 16px; color: black;
                font-family: Helvetica'>Logout</a>

                    <?php
                }
                ?>
                <a href="<?= BASE_URL ?>/cart/holding/"
                   style='text-decoration: none; font-size: 16px; color: black; font-family: Helvetica'>(<?= $count ?>)Cart</a>

                <!-- div  block to details auto suggestion -->
            </div>
        </div>
        <div id="suggestionDiv"></div>
        <hr>
        <?php
    } //end of details header function

    //method to details page footer
    public static function displayFooter()
    {

        ?>
        </div>
        <br><br><br>
        <div class="push"></div>
        <div class="footer">
            <br>&copy 2021 GamePlanet • All Rights Reserved.
            <br><br>
        </div>

        </body>
        </html>
        <?php
    } //end of displayFooter function
}