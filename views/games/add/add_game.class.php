<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/7/2021
 * File: add_game.class.php
 * Description: This is the View class that contains a form that allows admin to add a game to the  database.
 */
class AddGame extends IndexView
{
    public function display()
    {
        parent::displayHeader("Add Game");

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

//
        ?>

        <div class="top-row">Add Game</div>
            <!-- display game details in a form -->
            <div class="middle-row add-game" style=" margin: auto;">
                <form action='<?= BASE_URL . "/game/add/" ?>' method="post">
                    <table class="add-table" cellspacing="0" cellpadding="3"
                           >
                        <tr>
                            <td><input name="title" type="text" size="55%" placeholder="Title" required/></td>
                        </tr>
                        <tr>
                            <td><input name="price" type="text" size="55%" placeholder="Price" required/></td>
                        </tr>
                        <tr>
                            <td>
                                <select id="select" name="name" >
                                    <option value="1">Nintendo Wii</option>
                                    <option value="2">XBox 360</option>
                                    <option value="3">Nintendo Gamecube</option>
                                    <option value="4">PlayStation 2</option>
                                    <option value="5">PlayStation 4</option>
                                    <option value="6">Nintendo 3DS</option>
                                    <option value="7">Nintendo 64</option>
                                    <option value="8">Nintendo Switch</option>
                                    <option value="9">Super Nintendo</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select  id="select" name="rating_id" col="55">
                                    <option value="1">T</option>
                                    <option value="2">M</option>
                                    <option value="3">E</option>
                                    <option value="4">K-A</option>
                                    <option value="5">E10+</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input name="publish_year" type="text" size="55%" placeholder="Publish Year" required/></td>
                        </tr>
                        <tr>
                            <td>
                                <select id="select" name="publisher_id">
                                    <option value="1">Nintendo</option>
                                    <option value="2">Ubisoft</option>
                                    <option value="3">Atari</option>
                                    <option value="4">Activision</option>
                                    <option value="5">Microsoft Game Studios</option>
                                    <option value="6">Sony Computer Entertainment</option>
                                    <option value="7">Bethesda Softworks</option>
                                    <option value="9">2k Games</option>
                                    <option value="10">Blizzard Entertainment</option>
                                    <option value="11">Namco</option>
                                    <option value="12">Flex</option>
                                    <option value="13">Oculus</option>
                                    <option value="14">Xbox Game Studios</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input name="genre" type="text" size="55%" placeholder="Genre" required/></td>
                        </tr>
                        <tr>
                            <td><input name="image" type="text" size="55%" placeholder="Image.jpg or .png" required/></td>
                        </tr>
                        <tr>
                            <td><textarea style="padding: 11px; resize: none;" rows="8" cols="49%" name="description" placeholder="Description"
                                          required=""></textarea></td>
                        </tr>
                        <tr>
                            <td><input style="margin-top: 1px; margin-left: 35%;" class="admin-button" type="submit" value="Add"
                                       onclick='window.location.href = "<?= BASE_URL . "/game/add/" ?>"'/></td>
                        </tr>
                    </table>
            </div>
            </form>
        </div>
        <?php
        parent::displayFooter();
    }
}