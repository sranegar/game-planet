<?php

/**
 * Author: Collin Hill
 * Date: 11/10/2021
 * File: game_index.class.php
 * Description: This is the View class that defines a method called "details", which displays all games.
 */
class GameIndex extends IndexView
{
    public function display($games)
    {
        //details page header
        parent::displayHeader("Video Games");
        ?>
        <div class="top-row">Video Games</div>
        <div class="grid-container">
            <?php
            if ($games === 0) {
                echo "No game was found.<br><br><br><br><br>";
            } else {
                //details games in a grid; 6 games per row
                foreach ($games as $i => $game) {
                    $games_id = $game->getId();
                    $title = $game->getTitle();
                    $price = $game->getPrice();
                    $system = $game->getSystem();
                    $publish_year = $game->getPublish_year();
                    $genre = $game->getGenre();
                    $rating = $game->getRating();
                    $image = $game->getImage();
                    if (strpos($image, "http://") === false and strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . GAME_IMG . $image;
                    }
                    if ($i % 5 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/game/details/$games_id'><img src='" . $image .
                        "'></a><span><strong style='font-size: 18px; color: #e41f49;'>$$price</strong><br><strong>$title</strong><br><i style='font-family: Lora; color: black; opacity: 70%;'>$system</i><br>$publish_year<br></span></p><button>Add To Cart</button>" . "</div>";

                    ?>
                    <?php
                    if ($i % 6 == 6 || $i == count($games) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>
        </div>
        </div>
        </div>
        <?php
        //details page footer
        parent::displayFooter();
    }
}
