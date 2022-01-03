<?php

/**
 * Author: Stephanie Ranegar
 * Date: 1/2/2022
 * File: admin.class.php
 * Description:
 */
class Admin extends IndexView
{
    public function display()
    {
        parent::displayHeader("Admin");
        ?>
        <div class="top-row">Admin Rights</div>
        <div class="admin-wrapper">
            <div class="admin-middle-row">
                <a href="<?= BASE_URL ?>/game/add_form/"><div class="admin-feature a1">Add Game</div></a>
                <a href="<?= BASE_URL ?>/system/add_form/"><div class="admin-feature a2">Add Console</div></a>
            </div>
            <div class="admin-middle-row">
                <a href="<?= BASE_URL ?>/game/index/"><div class="admin-feature a1">Edit Game</div></a>
                <a href="<?= BASE_URL ?>/system/index/"><div class="admin-feature a2">Edit Console</div></a>
            </div>
        </div>
        <?php
        parent::displayFooter();
    }
}