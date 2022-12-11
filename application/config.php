<?php
/**
 * Author: Collin Hill
 * Date: 11/10/2021
 * File: config.php
 * Description: Set application settings
 */

//error reporting level: 0 to turn off all error reporting; E_ALL to report all
error_reporting(E_ALL);

//local time zone
date_default_timezone_set('America/New_York');

//base url of the application
define("BASE_URL", "https://plankton-app-vrsin.ondigitalocean.app");



/*************************************************************************************
 *                       settings for games                                        *
 ************************************************************************************/

//define default path for media images
//images not uploaded yet
define("GAME_IMG", "www/img/games/");
define("SYSTEM_IMG", "www/img/systems/");
define("BANNER_IMG", "www/img/banner/");