<?php

/**
 * Author: Melissa Boyer
 * Date: 12/6/2021
 * File: game_details.class.php
 * Description: This is the View class for displaying individual game details.
 */
class GameDetails extends IndexView
{
    public function display($game, $result)
    {
        parent::displayHeader("Game Details");
        //start session

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $login = '';

        //if the user is logged in, retrieve the user's role
        if (isset($_SESSION['role'])) {
            $role = $_SESSION['role'];
        }

        //if the user has logged in, retrieve login
        if (isset($_SESSION['login'])) {
            $login = $_SESSION['login'];
        }

        //retrieve game details by calling get methods
        $games_id = $game->getId();
        $title = $game->getTitle();
        $price = $game->getPrice();
        $system = $game->getSystem();
        $publisher = $game->getPublisher();
        $publish_year = $game->getPublish_year();
        $genre = $game->getGenre();
        $rating = $game->getRating();
        $image = $game->getImage();
        $description = $game->getDescription();

        if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . GAME_IMG . $image;
        }
        ?>
        <div>
            <div class="top-row">Game Details</div>
            <div class="middle-row all-games" style="margin-top: 8px; font-family: 'Arial Narrow'">Video Games /
                <a href="<?= BASE_URL ?>/game/index" style="text-decoration: none; font-family: 'Arial Narrow'; ">All
                    Games</a>
                <h3 style="color: #a10505; padding: 5px; font-size: 15px; font-family:  'Arial Black'"><?= $result ?></h3>

                <div class="details-wrapper">
                    <table class="details" id="detail">
                        <form action='<?= BASE_URL ?>/game/buy/<?= $games_id ?>' method="get">
                            <input type="hidden" name="games_id" id="id" value="<?= $games_id ?>"/>
                            <div style="width: 300px; background-color: #e6e5e5">
                                <img style="width: 300px; height: 450px; padding:10px;" src="<?= $image ?>"
                                     alt="<?= $title ?>"/>
                            </div>
                            <div style="margin-left: 20px">
                                <tr>
                                    <td>
                                        <h1><?= $title ?></h1>
                                        <p style="font-family: Lora; font-style: italic; font-size: 17.5px; color: black; opacity: 70%; margin-top: -24px"><?= $system ?></p>
                                        <h3 style="color: #e41f49" name="">$<?= $price ?></h3>
                                        <strong><p>Rated: <?= $rating ?></strong> | <?= $genre ?> </p>

                                        <input type="submit" class="cart-button" value="Add To Cart"><br>
                                        <hr>
                                        <h3 style="margin-top: 8px">Product Description</h3>
                                        <p style="margin-top: -13px; font-size: 12px"
                                           class="media-description"><?= $description ?></p>
                                        <p style="margin-top: -13px; font-size: 14px"><?= $publisher . " " . $publish_year ?></p>

                                    </td>
                                </tr>
                            </div>
                        </form>
                    </table>
                    <div>
                        <p> <?php
                            if (!empty($login) && $role == 1) {
                                ?>
                                <input type="button" class="admin-button" value="Edit Game"
                                       onclick="window.location.href = '<?= BASE_URL ?>/game/edit/<?= $games_id ?>'">
                                <?php
                            }
                            ?></p>
                    </div>
                </div>

                <!--display the follower button only if the user's role is 1 (admin)-->
            </div>
            <div>
                <br>
                <br>
            </div>
        </div>


        <?php
        parent::displayFooter();
    }
}