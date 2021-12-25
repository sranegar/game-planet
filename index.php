<?php
/**
 * Author: Stephanie
 * Date: 11/10/2021
 * File: index.php
 * Description: Dispatcher/router home page.
 */

//load application settings
require_once ("application/config.php");

//load autoloader
require_once ("vendor/autoload.php");

//load the dispatcher that dissects a request URL
new Dispatcher();
