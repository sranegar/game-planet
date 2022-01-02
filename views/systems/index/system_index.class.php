<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/19/2021
 * File: system_index.class.php
 * Description:
 */
class SystemIndex extends IndexView
{
    public function display($systems)
    {
        //details page header
        parent::displayHeader("Shop Consoles");
        ?>
        <div class="top-row">Game Consoles</div>
        <div class="grid-container">
            <?php
            if ($systems === 0) {
                echo "No system was found.<br><br><br><br><br>";
            } else {
                //details games in a grid; 6 games per row
                foreach ($systems as $i => $system) {
                    $system_id = $system->getId();
                    $publisher = $system->getPublisher();
                    $name = $system->getName();
                    $price = $system->getPrice();
                    $image = $system->getImage();

                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . SYSTEM_IMG . $image;
                    }
                    if ($i % 5 == 0) {
                        echo "<div class='row'>";
                    }

                    echo "<div class='col'><p><a href='", BASE_URL, "/system/details/$system_id'><img src='" . $image .
                        "'></a><span><strong style='font-size: 18px; color: #e41f49;'>$$price</strong><br><strong>$name</strong><br><i style='font-family: Lora; color: black; opacity: 70%;'>$publisher</i></span></p><button>Add To Cart</button>" . "</div>";
                    ?>
                    <?php
                    if ($i % 6 == 6 || $i == count($systems) - 1) {
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>
        </div>
        <br>
        <br>
        <?php
        //details page footer
        parent::displayFooter();
    }
}