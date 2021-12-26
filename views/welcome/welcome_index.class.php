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

        $banner_model = BannerModel::getBannerModel();

        //details page header
        parent::displayHeader("GamePlanet Official Site");
        ?>
        <div class="welcome-header">
        </div>
        <img src="<?= BASE_URL ?>/www/img/index_banner.jpg" style="margin-left: 13.5px; margin-bottom: 20px; width: 1052.5px">
        <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel" style="margin-left: 13.5px; margin-bottom: 20px; width: 1052.5px; height: 300px;">
            <ol class="carousel-indicators">
                <?php $banner_model->make_slide_indicators() ?>
            </ol>

            <div class="carousel-inner">
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
        <br>
        <br>
        <br>
        <?php
        //details page footer
        parent::displayFooter();
    }

}