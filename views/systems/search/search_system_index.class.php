<?php

/**
 * Author: Stephanie Ranegar
 * Date: 1/2/2022
 * File: search_system_index.class.php
 * Description:
 */
class SearchSystemIndex extends IndexView
{
    public function display($terms, $systems)
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
            if ($systems === 0) {
                echo "<h2 style='color: deeppink; padding: 10px;'>No game was found.</h2><br><br><br><br><br>";
            } else {
                //details games in a grid; 6 games per row
                foreach ($systems as $i => $system) {
                    $system_id = $system->getId();
                    $name = $system->getName();
                    $price = $system->getPrice();
                    $publisher = $system->getPublisher();
                    $image = $system->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . SYSTEM_IMG . $image;
                    }
                    if ($i % 5 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/game/details/$system_id'><img src='" . $image .
                        "' alt='" . $name . "'></a><span><strong style='font-size: 18px; color: #e41f49;'>$$price</strong><br><strong>$name</strong><br><i style='font-family: Lora; color: black; opacity: 70%;'>$publisher</i></span></p><button>Add To Cart</button>" . "</div>";
                    ?>
                    <?php
                    if ($i % 6 == 6 || $i == count($systems) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>
        <?php
        //details page footer
        parent::displayFooter();
    }
}