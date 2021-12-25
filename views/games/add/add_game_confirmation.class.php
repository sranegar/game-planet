<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/8/2021
 * File: add_game_confirmation.class.php
 * Description: This is the View class that contains confirmation page displaying if add game failed or was successful.
 */
class AddGameConfirmation extends IndexView
{
    public function display($result)
    {
        parent::displayHeader("Add Game");
//
        ?>

            <div class="top-row">Confirmation</div>
        <div class="form-wrapper">

            <!-- display game details in a form -->
            <div class="middle-row">
                <h2 style="color: #000"><?= $result ?></h2>
                <br>
                <br>
                <br>
                <br>
                <br>
                <input class="admin-button" style="margin-left: 39%;" type="button" value="Add Game"
                       onclick="window.location.href = '<?= BASE_URL ?>/game/add_form'">
            </div>
            <br>
            <br>
        </div>
        <?php
        parent::displayFooter();
    }
}