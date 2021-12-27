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
                        $system = $tgame->getSystem();
                        $publish_year = $tgame->getPublish_year();
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
                <a href="<?= BASE_URL ?>/game/details/61"><img class="left-img" src="<?= BASE_URL ?>/www/img/top_game_2021.jpg"/></a>
            </div>
            <div class="deals-left-content">
                <h4>Super Smash Bros. Ultimate</h4>
                <p>Challenge others anytime, anywhere.</p>
                <a href="<?= BASE_URL ?>/game/details/61"><h5>Shop Now <i class="fas fa-chevron-right" style="font-size: .8em; margin-left: 2px;"></i></h5></a>
            </div>
            <div class="deals-right"></div>
        </div>
        <div class="post-slider">
            <h2 class="slider-title" style="margin-bottom: -1px;">Top Consoles</h2>
            <i class="far fa-caret-square-left prev"></i>
            <i class="far fa-caret-square-right next"></i>
            <div class="post-wrapper">
                <?php
                if ($tsystems === 0) {
                    echo "No systems found.<br><br><br><br><br>";
                } else {
                    foreach ($tsystems as $x => $tsystem) {
                        $system_id = $tsystem->getId();
                        $name = $tsystem->getName();
                        $image = $tsystem->getImage();
                        if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
                            $image = BASE_URL . "/" . SYSTEM_IMG . $image;
                        }
                        echo "<div class='post'><a href='" . BASE_URL . "/system/details/" . $system_id . "' style='text-decoration: none; outline: none'><div class='card-wrapper'><img src='" . $image . "' alt='' class='slider-image' style='padding: 25px;'></a><div class='post-info'>" . $name . "</div></div></div>";

                        ?>
                        <?php
                    }
                    ?>

                    <?php
                }
                ?>
            </div>
        </div>
        </div>
        </div>
        <br>
        <?php
        //details page footer
        parent::displayFooter();
    }

}