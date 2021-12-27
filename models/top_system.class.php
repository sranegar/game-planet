<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/27/2021
 * File: top_system.class.php
 * Description:
 */
class TopSystem
{
    //private data members
    private $top_systems_id, $system_id, $name, $image;

    //the constructor
    public function __construct($system_id, $name, $image)
    {
        $this->system_id = $system_id;
        $this->name = $name;
        $this->image = $image;
    }

    //getters
    public function getId()
    {
        return $this->system_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    //set game id
    public function setId($top_systems_id)
    {
        $this->top_systems_id = $top_systems_id;
    }
}