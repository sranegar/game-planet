<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/25/2021
 * File: add_system_confirmation.class.php
 * Description:
 */
class AddSystemConfirmation extends IndexView
{
    public function display($result)
    {
        parent::displayHeader("Add System");
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
                <input class="admin-button" style="margin-left: 39%;" type="button" value="Add System"
                       onclick="window.location.href = '<?= BASE_URL ?>/system/add_form'">
            </div>
            <br>
            <br>
        </div>
        <?php
        parent::displayFooter();
    }
}