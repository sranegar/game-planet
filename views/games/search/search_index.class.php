<?php
/**
 * Author: Collin Hill
 * Date: 12/2/2021
 * File: search_index.class.php
 * Description: This is the View class that defines a method called "search", which displays all searched games.
 */

class SearchIndex extends IndexView
{
    public function display($terms, $games)
    {
        //details page header
        parent::displayHeader("Search all Games");
        ?>
        <div class="top-row">Search</div>
        <div class="main-header">
            Search Results for <i><strong>'<?= $terms ?>'</strong></i>
        </div>
        <div class="grid-container">
            <?php
            if ($games === 0) {
                echo "<h2 style='color: deeppink; padding: 10px;'>No game was found.</h2><br><br><br><br><br>";
            } else {
                //details games in a grid; 6 games per row
                foreach ($games as $i => $game) {
                    $games_id = $game->getId();
                    $title = $game->getTitle();
                    $price = $game->getPrice();
                    $system = $game->getSystem();
                    $publish_year = $game->getPublish_year();
                    $image = $game->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
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