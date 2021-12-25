<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/19/2021
 * File: system_details.class.php
 * Description:
 */
class SystemDetails extends IndexView
{
    public function display($system, $result)
    {
        parent::displayHeader("System Details");
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
        $system_id = $system->getId();
        $name = $system->getName();
        $publisher = $system->getPublisher();
        $price = $system->getPrice();
        $image = $system->getImage();
        $description = $system->getDescription();

        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . SYSTEM_IMG . $image;
        }
        ?>
        <div>
            <div class="top-row">System Details</div>
            <div class="middle-row all-games"style="margin-top: 8px; font-family: 'Arial Narrow'">Game Consoles /
                <a href="<?= BASE_URL ?>/game/index" style="text-decoration: none; font-family: 'Arial Narrow'; ">All Consoles</a>
                <h3 style="color: #a10505; padding: 5px; font-size: 15px; font-family:  'Arial Black'"><?= $result ?></h3>
                <div class="details-wrapper">
                    <table class="details" id="detail">
                        <div style="width: 300px; background-color: #e6e5e5">
                            <img style="width: 300px; height: 450px; padding:10px;" src="<?= $image ?>" alt="<?= $name ?>" />
                        </div>
                        <div style="margin-left: 20px">
                            <tr>
                                <td>
                                    <h1><?= $name ?></h1>
                                    <p style="font-family: Lora; color: black; opacity: 70%; margin-top: -20px"><?= $publisher ?></p>
                                    <h3 style="color: #e41f49">$<?= $price ?></h3>
<!--                                    <p>Rated: --><?//= $rating ?><!-- | --><?//= $genre ?><!-- </p>-->
                                    <form action='<?= BASE_URL . "/cart/index/" . $system_id ?>' method="get">
                                        <input type="submit" class="cart-button" value="Add To Cart" name="action"
                                               onclick='window.location.href = "<?= BASE_URL . "/cart/index/"?>"'><br>
                                    </form>
                                    <hr>
                                    <h3 style="margin-top: 8px">Product Description</h3>
                                    <p style="margin-top: -13px; font-size: 12px" class="media-description"><?= $description ?></p>
<!--                                    <p style="margin-top: -13px; font-size: 14px">--><?//= $publisher . " " . $publish_year ?><!--</p>-->
                                </td>
                            </tr>
                        </div>
                    </table>
                    <div>
                        <p> <?php
                            if (!empty($login) && $role == 1) {
                                ?>
                                <input type="button" class="admin-button" value="Edit Item"
                                       onclick="window.location.href = '<?= BASE_URL ?>/system/edit/<?= $system_id ?>'">
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
                <a href="<?= BASE_URL ?>/system/index" style="text-decoration: none; color: #0B4089FF"><span
                            style="float: left; font-family: Helvetica; margin-left: 20px;">Back to Consoles</span></a>
            </div>
        </div>
        <br>
        <br>

        <?php
        parent::displayFooter();
    }
}