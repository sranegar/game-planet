<?php

/**
 * Author: Stephanie Ranegar
 * Date: 11/10/2021
 * File: welcome_controller.class.php
 * Description: This scripts define the class for the welcome controller; this is the default controller.
 */
class WelcomeController
{
    //default constructor
    public function __construct()
    {
        //create an instance of the GameModel class
        $this->game_model = GameModel::getGameModel();
    }

    //put your code here
    public function index() {
        $tgames = $this->game_model->display_top_games();

        $view = new WelcomeIndex();
        $view->display($tgames);
    }

}