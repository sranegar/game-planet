<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/6/2021
 * File: edit_game.class.php
 * Description: This is the View class for displaying a form to the admin for editing game details.
 */
class EditGame extends IndexView
{
    public function display($game)
    {
        parent::displayHeader("Edit Game");

        //start session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        //get game ratings from a session variable
        if (isset($_SESSION['ratings'])) {
            $ratings = $_SESSION['ratings'];
        }

        //get publisher from a session variable
        if (isset($_SESSION['publisher'])) {
            $publishers = $_SESSION['publisher'];
        }

        //get publisher from a session variable
        if (isset($_SESSION['system'])) {
            $systems = $_SESSION['system'];
        }

        //retrieve game details by calling get methods
        $id = $game->getId();
        $title = $game->getTitle();
        $price = $game->getPrice();
        $system = $game->getSystem();
        $rating = $game->getRating();
        $publish_year = $game->getPublish_year();
        $publisher = $game->getPublisher();
        $genre = $game->getGenre();
        $image = $game->getImage();
        $description = $game->getDescription();

        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . GAME_IMG . $image;
        }
        ?>

        <div>
        <div class="top-row">Edit Game Details</div>
        <div class="mid-row">
                <form action='<?= BASE_URL . "/game/update/" . $id ?>' method="post"
                      style="margin-top: 10px; padding: 10px;">
                    <table class="details" id="detail">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <tr>
                        <td>
                            <img src="<?= $image ?>" alt="<?= $title ?>" />
                        </td>
                        <td style="width: 140px;">
                            <p>Title:</p>
                            <p style="margin-top: 20px">Price:</p>
                            <p style="margin-top: 20px">System:</p>
                            <p style="margin-top: 30px">Rating:</p>
                            <p style="margin-top: 35px">Publisher:</p>
                            <p style="margin-top: 45px">Publish Year:</p>
                            <p style="margin-top: 20px">Genre:</p><br>
                            <p>Description:</p>
                            <p style="margin-top: 148px">Image:</p>
                        </td>
                        <td>
                            <p><input name="title" type="text" size="40" value="<?= $title ?>" required=""></p>
                            <p><input name="price" type="text" value="<?= $price ?>"
                                      required=""></p>
                            <p>   <?php
                                foreach ($systems as $g_system => $g_id) {
                                    $checked = ($system == $g_system) ? "checked" : "";
                                    echo "<input type='radio' name='system' value='$g_id' $checked> $g_system &nbsp;&nbsp;";
                                }
                                ?></p>
                            <p>   <?php
                                foreach ($ratings as $g_rating => $g_id) {
                                    $checked = ($rating == $g_rating) ? "checked" : "";
                                    echo "<input type='radio' name='rating' value='$g_id' $checked> $g_rating &nbsp;&nbsp;";
                                }
                                ?></p>
                            <p> <?php
                                foreach ($publishers as $g_publisher => $g_id) {
                                    $checked = ($publisher == $g_publisher) ? "checked" : "";
                                    echo "<input type='radio' name='publisher' value='$g_id' $checked> $g_publisher &nbsp;&nbsp;";
                                }
                                ?></p>
                            <p><input name="publish_year" type="text" value="<?= $publish_year ?>"
                                      required=""></p>
                            <p><input name="genre" type="text" size="40" value="<?= $genre ?>" required=""></p>
                            <p><textarea style="resize: none;" rows = "10" cols = "80" name="description" required="" id="description"><?= $description ?></textarea></p>
                            <p><input name="image" type="text" size="80"  value="<?= $image ?>"></p>
                            <div class="buttons-wrapper">
                                <input class="admin-button" type="submit" name="action" value="Update Game"
                                       onclick='window.location.href = "<?= BASE_URL . "/game/update/" . $id ?>"'>
                                <input style="margin-left: 20px" class="admin-button" type="button" value="Cancel"
                                       onclick='window.location.href = "<?= BASE_URL . "/game/details/" . $id ?>"'>
                            </div>
                        </td>
                    </tr>
                    </table>
                </form>
        </div>
        <?php
        parent::displayFooter();
    }
}