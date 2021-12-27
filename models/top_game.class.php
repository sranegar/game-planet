<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/26/2021
 * File: top_game.class.php
 * Description:
 */
class TopGame
{
//private data members
    private $top_games_id, $games_id, $title, $price, $console, $publish_year, $image;

    //the constructor
    public function __construct($games_id, $title, $price, $console, $publish_year, $image)
    {
        $this->games_id = $games_id;
        $this->title = $title;
        $this->price = $price;
        $this->console = $console;
        $this->publish_year = $publish_year;
        $this->image = $image;
    }

    //getters
    public function getId()
    {
        return $this->games_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getSystem()
    {
        return $this->console;
    }

    public function getPublish_year()
    {
        return $this->publish_year;
    }

    public function getImage() {
        return $this->image;
    }

    //set game id
    public function setId($top_games_id)
    {
        $this->top_games_id = $top_games_id;
    }
}