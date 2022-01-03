<?php

/**
 * Author: Melissa Boyer
 * Date: 11/10/2021
 * File: GameError.php
 * Description: This is the View page for displaying an error.
 */
class GameError extends IndexView
{
    public function display($message)
    {

        //details page header
        parent::displayHeader("Error");
        ?>
        <div class="top-row">Error</div>
        <div class="middle-row">
            <h2 style="font-family: Helvetica,sans-serif"> Sorry, but an error has occurred.</h2>
            <h3 style="padding: 26px; margin-top: -60px; font-family: Lora; color: #a10505"><i class="fas fa-exclamation-circle"></i> <?= urldecode( $message) ?></h3>
        </div>
        <br>
        <br>
        <?php
        //details page footer
        parent::displayFooter();
    }
}