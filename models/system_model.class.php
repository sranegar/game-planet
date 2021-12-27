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
    private $tblTopSystems;


    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getGameModel method must be called.
    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblSystem = $this->db->getSystemTable();;
        $this->tblPublisher = $this->db->getPublisherTable();
        $this->tblTopSystems = $this->db->getTopSystemsTable();

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
            throw new DatabaseException("There was a problem connecting to the database.");
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

    //get game publisher
    private function get_top_systems()
    {
        try {
            $sql = "SELECT * FROM " . $this->tblTopSystems;

            //execute the query
            $query = $this->dbConnection->query($sql);

            //if query is successful
            if ($query) {

                //create an array and loop through all rows
                $top_systems = array();
                while ($obj = $query->fetch_object()) {
                    $top_systems[$obj->top_system] = $obj->top_systems_id;
                }
                return $top_systems;
            }
            $errmsg = $this->dbConnection->error();
            throw new DatabaseException("There was a problem connecting to the database.");
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

            //if query succeeded and systems are found
            if ($query && $query->num_rows > 0) {

                //handle the result
                //create an array to store all returned systems
                $systems = array();

                //loop through all rows in the returned set
                while ($obj = $query->fetch_object()) {
                    $system = new System(stripslashes($obj->name), stripslashes($obj->publisher), stripslashes($obj->price), stripslashes($obj->image), stripslashes($obj->description));

                    //set the id for the system
                    $system->setId($obj->system_id);

                    //add the system into the array
                    $systems[] = $system;
                }
                return $systems;
            }
            $errmsg = $this->dbConnection->error();
            throw new DatabaseException("There was a problem connecting to the database.");
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

    public function display_top_system()
    {
        try {
            $sql = "SELECT " . $this->tblTopSystems . ".top_systems_id, " . $this->tblSystem . ".system_id, " . $this->tblSystem . ".name, " . $this->tblSystem . ".image " .
                " FROM " . $this->tblTopSystems . "," . $this->tblSystem .
                " WHERE " . $this->tblTopSystems. ".system_id=" . $this->tblSystem . ".system_id";
            //execute the query
            $query = $this->dbConnection->query($sql);

            //if query succeeded and games are found
            if ($query && $query->num_rows > 0) {

                //handle the result
                //create an array to store all returned games
                $top_systems = array();

                //loop through all rows in the returned set
                while ($obj = $query->fetch_object()) {
                    $top_system = new TopSystem(stripslashes($obj->system_id), stripslashes($obj->name), stripslashes($obj->image));

                    //set the id for the game
                    $top_system->setId($obj->top_systems_id);

                    //add the game into the array
                    $top_systems[] = $top_system;
                }
                return $top_systems;
            }
            $errmsg = $this->dbConnection->error();
            throw new DatabaseException("There was a problem connecting to the database.");
        } catch (DatabaseException $e) {
            $error = new GameError();
            $error->display($e->getMesssage());
            return false;
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem listing games.");
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

                //create a system object
                $system = new System(stripslashes($obj->name), stripslashes($obj->publisher), stripslashes($obj->price), stripslashes($obj->image), stripslashes($obj->description));

                //set the id for the system
                $system->setId($obj->system_id);

                return $system;
            }
            $errmsg = $this->dbConnection->error();
            throw new DatabaseException("There was a problem connecting to the database.");
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

    //method for updating system into the database
    public function update_system($id)
    {
        //retrieve data for the system; data are sanitized and escaped for security.
        $name = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)));
        $price = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'price', FILTER_DEFAULT));
        $publisher = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $description = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));


        try {
            //handle if any of the fields were left empty
            if (empty($name) || empty($price) || empty($publisher) || empty($image) || empty($description)) {
                throw new DataMissingException ("Values are missing in one or more fields. All fields must be filled.");
                return false;
            }


            //query string for update
            $sql = "UPDATE " . $this->tblSystem .
                " SET name='$name', publisher_id='$publisher', price='$price', image='$image', description='$description' "
                . "WHERE system_id=" . $id;

            //execute the query and return true if successful or false if failed
            if ($this->dbConnection->query($sql) === FALSE) {
                throw new DatabaseException("We are sorry, but we can't update your system at the moment. Please try again later.");
            }
            return "Your system has successfully been updated.";
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem updating the system.");
            return false;
        }
    }


    //add system to database as an admin
    public function add_system()
    {
        //retrieve data for the new system; data are sanitized and escaped for security.
        $name = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)));
        $price = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'system_price', FILTER_DEFAULT));
        $publisher = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'system_publisher_id', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $description = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));

        try {
            //handle if any of the fields were left empty
            if (empty($name) || empty($price) || empty($publisher) || empty($image) || empty($description)) {
                throw new DataMissingException ("Values are missing in one or more fields. All fields must be filled.");
                return false;
            }

            //query string for update
            $sql = "INSERT INTO $this->tblSystem VALUES (NULL, '$name', '$publisher','$price', '$image', '$description')";


            //execute the query and return true if successful or false if failed
            if ($this->dbConnection->query($sql) === FALSE) {
                throw new DatabaseException("We are sorry, but we can't add your system at the moment. Please try again later.");
            }
            return "Your system has successfully been added.";
        } catch (DataMissingException $e) {
            return $e->getMessage();
        } catch (DatabaseException $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            $error = new GameError();
            $error->display("There was a problem adding the system.");
            return false;
        }
    }
}