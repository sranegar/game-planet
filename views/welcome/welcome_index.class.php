<?php

/**
 * Author: Melissa Boyer
 * Date: 11/10/2021
 * File: welcome_index.class.php
 * Description: This class defines the method "details" that displays the home page.
 */
class WelcomeIndex extends WelcomeIndexView
{
    public function display($tgames, $tsystems)
    {
        $banner_model = BannerModel::getBannerModel();

        //details page header
        parent::displayHeader("GamePlanet Official Site");

        //if the use has logged in, retrieve login, name, and role.
        if (isset($_SESSION['login']) and isset($_SESSION['firstname']) and
            isset($_SESSION['role'])) {
            $login = $_SESSION['login'];
            $firstname = $_SESSION['firstname'];
            $role = $_SESSION['role'];
        }

        ?>
        <img src="<?= BASE_URL ?>/www/img/index_banner.jpg"
             style="margin-left: 13.5px; margin-bottom: 20px; width: 1052.5px">
        <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel"
             style="margin-left: 13.5px; margin-bottom: 20px; width: 1052.5px; height: 288px;">
            <ol class="carousel-indicators">
                <?php $banner_model->make_slide_indicators() ?>
            </ol>

            <div class="carousel-inner" style="height: 288px">
                <?php $banner_model->make_slides() ?>
            </div>
            <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="welcome">
            <div class="index">
                <a style="text-decoration: none;" href="<?= BASE_URL ?>/game/index"> <img
                            src="<?= BASE_URL ?>/www/img/video_games.jpg" title="Game Library"
                            style="width: 520px;"/>
                    <div class="shop-games">Shop Games</div>
                </a>
            </div>
            <div class="index">
                <a style="text-decoration: none;" href="<?= BASE_URL ?>/system/index"><img
                            src="<?= BASE_URL ?>/www/img/systems_library.jpg" title="Consoles & Hardware"
                            style="width: 520px;"/>
                    <div class="shop-hardware">Shop Consoles & Hardware</div>
                </a>
            </div>
        </div>

        <div class="post-slider">
            <h2 class="slider-title" style="margin-bottom: -1px;">Top Games</h2>
            <i class="far fa-caret-square-left prev"></i>
            <i class="far fa-caret-square-right next"></i>
            <div class="post-wrapper">
                <?php
                if ($tgames === 0) {
                    echo "No game was found.<br><br><br><br><br>";
                } else {
                    foreach ($tgames as $i => $tgame) {
                        $games_id = $tgame->getId();
                        $title = $tgame->getTitle();
                        $image = $tgame->getImage();
                        if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
                            $image = BASE_URL . "/" . GAME_IMG . $image;
                        }
                        echo "<div class='post'><a href='" . BASE_URL . "/game/details/" . $games_id . "' style='text-decoration: none; outline: none'><div class='card-wrapper'><img src='" . $image . "' alt='' class='slider-image'></a><div class='post-info'>" . $title . "</div></div></div>";

                        ?>
                        <?php
                    }
                    ?>

                    <?php
                }
                ?>
            </div>
        </div>

        <div class="deals">
            <div class="deals-left">
                <a href="<?= BASE_URL ?>/game/details/61"><img class="left-img"
                                                               src="<?= BASE_URL ?>/www/img/top_game_2021.jpg"/></a>
            </div>
            <div class="deals-left-content">
                <h4>Super Smash Bros. Ultimate</h4>
                <p>Challenge others anytime, anywhere.</p>
                <a href="<?= BASE_URL ?>/game/details/61" style="text-decoration: none;"><h5>Shop Now <i
                                class="fas fa-chevron-right"
                                style="font-size: .8em; margin-left: 2px;"></i>
                    </h5></a>
            </div>
            <div class="deals-right">
                <div class="deals-right">
                    <a href="<?= BASE_URL ?>/game/details/62"><img class="right-img"
                                                                   src="<?= BASE_URL ?>/www/img/games/age_of_empires_IV.jpg"/></a>
                </div>
                <div class="deals-right-content">
                    <h4>Age of Empires IV</h4>
                    <p>Discover your next favorite game.</p>
                    <a href="<?= BASE_URL ?>/game/details/62" style="text-decoration: none;"><h5>View More
                        </h5></a>
                </div>
            </div>
        </div>
        <div class="bottom-nav">
            <div class="nav-wrapper">
                <a href="<?= BASE_URL ?>/game/index" style='text-decoration: none;  margin-left: 62px; font-size: 14px; color: black;
                font-family: Helvetica'><div class="individual-wrapper"><i class="fas fa-gamepad" style="color: #05058b;"></i>
                    <p style="margin-top: 6px; font-size: 13px; color: #000; text-transform: uppercase; font-family: 'Arial Narrow'">Games</p></div></a>
                <a href="<?= BASE_URL ?>/system/index" style='text-decoration: none;  margin-left: 62px; font-size: 14px; color: black;
                font-family: Helvetica'><div class="individual-wrapper"><i class="fas fa-power-off" style="color: #2d0a78;"></i>
                        <p style="margin-top: 6px; font-size: 13px; color: #000; text-transform: uppercase; font-family: 'Arial Narrow'">Consoles</p></div></a>
        <?php
        if (empty($login)) {
            ?>
                <a href="<?= BASE_URL ?>/user/login" style='text-decoration: none;  margin-left: 62px; font-size: 14px; color: black;
                font-family: Helvetica'><div class="individual-wrapper"><i class="fas fa-user" style="color: #4c0a78;"></i>
                        <p style="margin-top: 6px; font-size: 13px; color: #000; text-transform: uppercase; font-family: 'Arial Narrow'">Account</p></div></a>
            <?php
        } else if ($role == 1) {
            ?>
            <a href="<?= BASE_URL ?>/user/admin" style='text-decoration: none;  margin-left: 62px; font-size: 14px; color: black;
                font-family: Helvetica'><div class="individual-wrapper"><i class="fas fa-user" style="color: #4c0a78;"></i>
                    <p style="margin-top: 6px; font-size: 13px; color: #000; text-transform: uppercase; font-family: 'Arial Narrow'">Admin</p></div></a>
            <?php
        } else {
            ?>
            <a href="<?= BASE_URL ?>/user/logout" style='text-decoration: none;  margin-left: 62px; font-size: 14px; color: black;
                font-family: Helvetica'><div class="individual-wrapper"><i class="fas fa-user" style="color: #4c0a78;"></i>
                    <p style="margin-top: 6px; font-size: 13px; color: #000; text-transform: uppercase; font-family: 'Arial Narrow'">Logout</p></div></a>

            <?php
        }
        ?>
                <a href="<?= BASE_URL ?>/cart/holding" style='text-decoration: none;  margin-left: 62px; font-size: 14px; color: black;
                font-family: Helvetica'><div class="individual-wrapper"><i class="fas fa-shopping-cart" style="color: #5c0a78;"></i>
                        <p style="margin-top: 6px; font-size: 13px; color: #000; text-transform: uppercase; font-family: 'Arial Narrow'">Cart</p></div></a>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <?php
        //details page footer
        parent::displayFooter();
    }

}