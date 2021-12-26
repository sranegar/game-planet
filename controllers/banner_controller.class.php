<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/26/2021
 * File: banner_controller.class.php
 * Description:
 */
class BannerController
{
    private $banner_model;

    //default constructor
    public function __construct()
    {
        //create an instance of the GameModel class
        $this->banner_model = BannerModel::getBannerModel();
    }
}