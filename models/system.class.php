<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/19/2021
 * File: system.class.php
 * Description: the System class models a real-world system.
 */
class System
{
    //private data members
    private $system_id, $name, $publisher, $price, $image, $description;

    //the constructor
    public function __construct($name, $publisher, $price, $image, $description)
    {
        $this->name = $name;
        $this->publisher = $publisher;
        $this->image = $image;
        $this->price = $price;
        $this->description = $description;
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

    public function getPublisher() {
        return $this->publisher;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getDescription()
    {
        return $this->description;
    }

    //set system id
    public function setId($system_id)
    {
        $this->system_id = $system_id;
    }
}