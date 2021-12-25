<?php

/**
 * Author: Collin Hill
 * Date: 11/10/2021
 * File: game.class.php
 * Description: the Game class models a real-world game.
 */

class Game
{
//private data members
    private $games_id, $title, $price, $console, $publisher, $publish_year, $genre, $rating, $image, $description;

    //the constructor
    public function __construct($title, $price, $console, $publisher, $publish_year, $genre, $rating, $image, $description)
    {
        $this->title = $title;
        $this->price = $price;
        $this->console = $console;
        $this->publisher = $publisher;
        $this->publish_year = $publish_year;
        $this->genre = $genre;
        $this->rating = $rating;
        $this->image = $image;
        $this->description = $description;
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


    public function getPublisher()
    {
        return $this->publisher;
    }

    public function getPublish_year()
    {
        return $this->publish_year;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    //set game id
    public function setId($games_id)
    {
        $this->games_id = $games_id;
    }
}