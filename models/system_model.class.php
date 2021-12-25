<?php

/**
 * Author: Stephanie Ranegar
 * Date: 12/19/2021
 * File: system_model.class.php
 * Description:
 */
class SystemModel
{
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblSystem;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getGameModel method must be called.
    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblSystem = $this->db->getSystemTable();;
        $this->tblPublisher = $this->db->getPublisherTable();

        //start session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initialize publisher
        if (!isset($_SESSION['publisher'])) {
            $publisher = $this->get_publisher();
            $_SESSION['publisher'] = $publisher;
        }
    }

    //static method to ensure there is just one GameModel instance
    public static function getSystemModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new SystemModel();
        }
        return self::$_instance;
    }

    //get publisher
    private function get_publisher()
    {
        try {
            $sql = "SELECT * FROM " . $this->tblPublisher;

            //execute the query
            $query = $this->dbConnection->query($sql);

            //if query is successful
            if ($query) {

                //create an array and loop through all rows
                $publishers = array();
                while ($obj = $query->fetch_object()) {
                    $publishers[$obj->publisher] = $obj->publisher_id;
                }
                return $publishers;
            }
            $errmsg = $this->dbConnection->error();
            throw new DatabaseException($e->getMessage());
        } catch (DatabaseException $e) {
            $error = new GameError();
            $error->display($e->getMesssage());
            return false;
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("An unexpected error has occurred.");
            return false;
        }
    }

    //method for listing all systems
    public function list_system()
    {
        try {
            $sql = "SELECT " . $this->tblSystem . ".system_id, " . $this->tblSystem . ".name, " . $this->tblPublisher . ".publisher, " . $this->tblSystem . ".price, " . $this->tblSystem . ".image, " . $this->tblSystem. ".description " .
                " FROM " . $this->tblSystem . "," . $this->tblPublisher .
                " WHERE " . $this->tblSystem . ".publisher_id=" . $this->tblPublisher . ".publisher_id" . " AND " . $this->tblSystem . ".system_id=" . $this->tblSystem . ".system_id";

//
//            print_r($sql);
            //execute the query
            $query = $this->dbConnection->query($sql);

            //if query succeeded and games are found
            if ($query && $query->num_rows > 0) {

                //handle the result
                //create an array to store all returned games
                $systems = array();

                //loop through all rows in the returned set
                while ($obj = $query->fetch_object()) {
                    $system = new System(stripslashes($obj->name), stripslashes($obj->publisher), stripslashes($obj->price), stripslashes($obj->image), stripslashes($obj->description));

                    //set the id for the game
                    $system->setId($obj->system_id);

                    //add the game into the array
                    $systems[] = $system;
                }
                return $systems;
            }
            $errmsg = $this->dbConnection->error();
            throw new DatabaseException($e->getMessage());
        } catch (DatabaseException $e) {
            $error = new GameError();
            $error->display($e->getMesssage());
            return false;
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem listing systems.");
            return false;
        }
    }

    //method for viewing system details
    public function view_system($system_id)
    {
        try {
            //the select sql statement
            $sql = "SELECT " . $this->tblSystem . ".system_id, " . $this->tblSystem . ".name, " . $this->tblPublisher . ".publisher, " . $this->tblSystem . ".price, " . $this->tblSystem . ".image, " . $this->tblSystem. ".description " .
                " FROM " . $this->tblSystem . "," . $this->tblPublisher .
                " WHERE " . $this->tblSystem . ".publisher_id=" . $this->tblPublisher . ".publisher_id" . " AND " . $this->tblSystem . ".system_id=" . $system_id;

//            print_r($sql);
            //execute the query
            $query = $this->dbConnection->query($sql);

            if ($query && $query->num_rows > 0) {
                $obj = $query->fetch_object();

                //create a game object
                $system = new System(stripslashes($obj->name), stripslashes($obj->publisher), stripslashes($obj->price), stripslashes($obj->image), stripslashes($obj->description));

                //set the id for the game
                $system->setId($obj->system_id);

                return $system;
            }
            $errmsg = $this->dbConnection->error();
            throw new DatabaseException($e->getMessage());
        } catch (DatabaseException $e) {
            $error = new GameError();
            $error->display($e->getMesssage());
            return false;
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem viewing system details.");
            return false;
        }
    }
}