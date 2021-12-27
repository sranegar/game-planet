<?php

/**
 * Author: Collin Hill
 * Date: 11/10/2021
 * File: database.class.php
 * Description: the Database class sets the database details.
 */
class Database
{
    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'gameshack_db',
        'tblGame' => 'games',
        'tblGameSystem' => 'games_system',
        'tblPublisher' => 'publisher',
        'tblRatings' => 'ratings',
        'tblSystem' => 'system',
        'tblUser' => 'users',
        'tblBanner' => 'banner',
        'tblTopGames' => 'top_games',
        'tblTopSystems' => 'top_systems'
    );

    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct()
    {
        try {
            $this->objDBConnection = @new mysqli(
                $this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']
            );
            if (mysqli_connect_errno() != 0) {
                $message = "Connecting database failed: " . mysqli_connect_error() . ".";
                throw new DatabaseException($message);
            }
        } catch (DatabaseException $e) {
            $error = new GameError();
            $error->display($e->getMessage());
            exit;
        }
    }

    //static method to ensure there is just one Database instance
    static public function getDatabase()
    {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection()
    {
        return $this->objDBConnection;
    }

    //returns the name of the table that stores games
    public function getGameTable()
    {
        return $this->param['tblGame'];
    }

    //returns the name of the table that stores game-system relation
    public function getGameSystemTable()
    {
        return $this->param['tblGameSystem'];
    }

    //returns the name of the table storing game publishers
    public function getPublisherTable()
    {
        return $this->param['tblPublisher'];
    }

    //returns the name of the table storing game ratings
    public function getRatingsTable()
    {
        return $this->param['tblRatings'];
    }

    //returns the name of the table storing game systems
    public function getSystemTable()
    {
        return $this->param['tblSystem'];
    }

    //returns the name of the table storing users
    public function getUserTable()
    {
        return $this->param['tblUser'];
    }

    //returns the name of the table storing users
    public function getBannerTable()
    {
        return $this->param['tblBanner'];
    }

    //returns the name of the table storing users
    public function getTopGamesTable()
    {
        return $this->param['tblTopGames'];
    }


    //returns the name of the table storing users
    public function getTopSystemsTable()
    {
        return $this->param['tblTopSystems'];
    }

}