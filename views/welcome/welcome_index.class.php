<?php

/**
 * Author: Melissa Boyer
 * Date: 11/10/2021
 * File: welcome_index.class.php
 * Description: This class defines the method "details" that displays the home page.
 */
class WelcomeIndex extends IndexView
{
    public function display()
    {
        //details page header
        parent::displayHeader("GamePlanet Official Site");
        ?>
        <div class="main-header">
        </div>
        <img src="<?= BASE_URL ?>/www/img/index_banner.jpg" style="margin-left: 13.5px; margin-bottom: 20px; width: 1052.5px">
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
        <br>
        <br>
        <br>
        <?php
        //details page footer
        parent::displayFooter();
    }

}