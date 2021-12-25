<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/25/2021
 * File: edit_system.class.php
 * Description:
 */
class EditSystem extends IndexView
{
    public function display($system)
    {
        parent::displayHeader("Edit System");

        //start session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        //get system ratings from a session variable
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

        //retrieve system details by calling get methods
        $id = $system->getId();
        $name = $system->getName();
        $price = $system->getPrice();
        $publisher = $system->getPublisher();
        $image = $system->getImage();
        $description = $system->getDescription();

        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . SYSTEM_IMG . $image;
        }
        ?>

        <div>
        <div class="top-row">Edit Game Details</div>
        <div class="middle-row">
            <form class="new-media" action='<?= BASE_URL . "/system/update/" . $id ?>' method="post"
                  style="margin-top: 10px; padding: 10px;">
                <table class="details" id="detail">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <tr>
                        <td style="width: 200px;">
                            <img src="<?= $image ?>" alt="<?= $name ?>" />
                        </td>
                        <td style="width: 140px;">
                            <p>Name:</p>
                            <p style="margin-top: 20px">Price:</p>
                            <p>Publisher:</p>
                            <p style="margin-top: 35px">Description:</p>
                            <p style="margin-top: 161px">Image:</p>
                        </td>
                        <td>
                            <p><input name="name" type="text" size="40" value="<?= $name ?>" required=""></p>
                            <p><input name="price" type="text" value="<?= $price ?>"
                                      required=""></p>
                            <p> <?php
                                foreach ($publishers as $s_publisher => $s_id) {
                                    $checked = ($publisher == $s_publisher) ? "checked" : "";
                                    echo "<input type='radio' name='publisher' value='$s_id' $checked> $s_publisher &nbsp;&nbsp;";
                                }
                                ?></p>
                            <p><textarea style="resize: none;" rows = "10" cols = "80" name="description" required="" id="description"><?= $description ?></textarea></p>
                            <p><input name="image" type="text" size="80"  value="<?= $image ?>"></p>
                            <div class="buttons-wrapper">
                                <input class="admin-button" type="submit" name="action" value="Update System"
                                       onclick='window.location.href = "<?= BASE_URL . "/system/update/" . $id ?>"'>
                                <input style="margin-left: 20px" class="admin-button" type="button" value="Cancel"
                                       onclick='window.location.href = "<?= BASE_URL . "/system/details/" . $id ?>"'>
                            </div>
                        </td>
                    </tr>
                    </tr>
                </table>
            </form>
        </div>
        <?php
        parent::displayFooter();
    }
}