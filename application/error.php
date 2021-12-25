<?php
/**
 * Author: Jacob Wells
 * Date: 11/10/2021
 * File: error.php
 * Description: This script displays an error message. This script is globally available throughout the application.
 *     The message to be displayed is passed to this script via variable $message. The dispatcher uses this to
 *     details an error message when the requested controller is not found.
 */

$page_title = "Error";
//details header
IndexView::displayHeader($page_title);

?>
<div class="top-row">Error</div>
    <div class="middle-row">
        <h2 style="font-family: Helvetica"> Sorry, but an error has occurred.</h2>
        <h4 style="padding: 26px; margin-top: -60px; font-family: 'Arial Narrow'; color: #a10505"><?= urldecode($message) ?></h4>
        </div>
    </div>
    <br>
    <br>
<br>
<?php
//details footer
IndexView::displayFooter();