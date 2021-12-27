<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/25/2021
 * File: add_system.class.php
 * Description:
 */
class AddSystem extends IndexView
{
    public function display()
    {
        parent::displayHeader("Add System");

        //start session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
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

        <div class="top-row">Add System</div>
        <!-- display game details in a form -->
        <div class="middle-row add-game" style=" margin: auto;">
            <form action='<?= BASE_URL . "/system/add/" ?>' method="post">
                <table class="add-table" cellspacing="0" cellpadding="3"
                >
                    <tr>
                        <td><input name="name" type="text" size="55%" placeholder="Name" required/></td>
                    </tr>
                    <tr>
                        <td><input name="system_price" type="text" size="55%" placeholder="Price" required/></td>
                    </tr>
                    <tr>
                        <td>
                            <select id="select" name="system_publisher_id">
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
                        <td><input name="image" type="text" size="55%" placeholder="Image.jpg or .png" required/></td>
                    </tr>
                    <tr>
                        <td><textarea style="padding: 11px; resize: none;" rows="8" cols="49%" name="description" placeholder="Description"
                                      required=""></textarea></td>
                    </tr>
                    <tr>
                        <td><input style="margin-top: 1px; margin-left: 35%;" class="admin-button" type="submit" value="Add"
                                   onclick='window.location.href = "<?= BASE_URL . "/system/add/" ?>"'/></td>
                    </tr>
                </table>
        </div>
        </form>
        </div>
        <?php
        parent::displayFooter();
    }
}