<?php

/**
 * Author: Stephanie Ranegar
 * Date: 1/2/2022
 * File: admin.class.php
 * Description:
 */
class Admin extends IndexView
{
    public function display($result)
    {
        parent::displayHeader("Admin");
        ?>
        <div class="top-row">Admin</div>
        <div class="form-wrapper">
            <div class="middle-row">
                <br>
                <h2><?= $result ?></h2>
            </div>
        </div>
        <?php
        parent::displayFooter();
    }
}